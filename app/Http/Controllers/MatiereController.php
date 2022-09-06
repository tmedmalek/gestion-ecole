<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMatiereRequest;
use App\Http\Resources\MatiereResource;
use App\Models\Matiere;
use App\Services\MatiereService;

class MatiereController extends Controller
{

    private $MatiereService;
    public function __construct(MatiereService $MatiereService)
    {
        $this->MatiereService = $MatiereService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        response(
            [
                'success' => 1,
                'data' => MatiereResource::collection(Matiere::all())
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
        $this->MatiereService->store($request->validate());
        return response(['success' => 1, 'message' => 'matiere is create'], 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $matiere = $this->MatiereService->getMatiere($id);
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
        $this->MatiereService->update($request->validate(), $id);
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
        $matiere->delete();
        return response(['success' => 1, 'message' => 'matiere is deleted'], 201);
    }
}
