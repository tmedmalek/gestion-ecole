<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfesseurRequest;
use App\Http\Resources\ProfesseurResource;
use App\Http\Resources\ProfesseurResourceCollection;
use App\Models\Classe;
use App\Models\Professeur;
use App\Services\ProfesseurService;

class ProfesseurController extends Controller
{

    private $ProfesseurService;

    public function __construct(ProfesseurService $ProfesseurService)
    {
        $this->ProfesseurService = $ProfesseurService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'success' => 1,
            'data' => new ProfesseurResourceCollection(Professeur::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfesseurRequest $request)
    {
        $professeur = $this->ProfesseurService->store($request->validated());
        if (isset($professeur)) {
            return response(['success' => 1, 'message' => 'professeur is create'], 201);
        }
        return response(['success' => -1, 'message' => 'professeur is existe'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $professeur = Professeur::firstwhere('id', $id);
        if (is_null($professeur)) {
            return response(['success' => -1, 'message' => 'is not found'], 200);
        }
        return response(
            [
                'success' => 1,
                'data' => new ProfesseurResource($professeur)
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
    public function update(StoreProfesseurRequest $request, $id)
    {
        $professeur = $this->ProfesseurService->update($request->validated(), $id);

        if (is_null($professeur)) {
            return response(['success' => -1, 'message' => 'is not found'], 200);
        }
        return response(['success' => 1, 'message' => 'professeur is updated'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $professeur = Professeur::where('id', $id)->first();
        if (is_null($professeur)) {
            return response(['success' => -1, 'message' => 'is not found'], 200);
        }

        $professeur->delete();
        return response(['success' => 1, 'message' => 'professeur is deleted'], 201);
    }
}
