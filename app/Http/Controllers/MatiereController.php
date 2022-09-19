<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Http\Requests\StoreMatiereRequest;
use App\Http\Resources\MatiereResource;
use App\Http\Resources\MatiereResourceCollection;
use App\Models\Matiere;
use App\Services\MatiereService;

class MatiereController extends Controller
{


    public function __construct(private MatiereService $MatiereService)
    {
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(
            [
                'success' => 1,
                'data' => new MatiereResourceCollection(Matiere::all())
            ],
            201
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMatiereRequest $request)
    {
        $matiere = $this->MatiereService->checkMatiereNotEXiste($request['name']);
        if (isset($matiere)) {
            throw new NotFoundException(['code' => -1, 'message' => 'matiere existe']);
        }

        $niveaux = $this->MatiereService->checkNiveauExiste($request['niveaux']);
        if (is_null($niveaux)) {
            throw new NotFoundException(['code' => -1, 'message' => 'niveau not found']);
        }

        $matiere = $this->MatiereService->store($request->validated());
        $this->MatiereService->setniveau($matiere, $request['niveaux']);
        return response(['success' => 1, 'message' => 'matiere is create'], 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Matiere $matiere)
    {
        return response(
            [
                'success' => 1,
                'data' => new MatiereResource($matiere)
            ],
            201
        );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMatiereRequest $request, $id)
    {

        $matiere =  $this->MatiereService->checkMatiereEXiste($request['name'], $id);
        if (isset($matiere)) {
            throw new NotFoundException(['code' => -1, 'message' => 'matiere existe']);
        }

        $matiere = $this->MatiereService->getMatiere($id);
        if (!$matiere) {
            throw new NotFoundException(['code' => -1, 'message' => 'matiere not found']);
        }

        $niveaux = $this->MatiereService->checkNiveauExiste($request['niveaux']);
        if (is_null($niveaux)) {
            throw new NotFoundException(['code' => -1, 'message' => 'niveau not found']);
        }
        $this->MatiereService->update($matiere, $request->validated());
        $this->MatiereService->setniveau($matiere, $request['niveaux']);

        return response(['succes' => -1, 'message' => 'Matiere is updated'], 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $matiere = $this->MatiereService->getMatiere($id);
        if (!$matiere) {
            throw new NotFoundException(['code' => -1, 'message' => 'matiere not found']);
        }
        $matiere->niveaux()->detach();
        $matiere->delete();
        return response(['success' => 1, 'message' => 'matiere is deleted'], 201);
    }
}
