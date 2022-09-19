<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfesseurRequest;
use App\Http\Requests\UpdateProfesseurRequest;
use App\Http\Resources\ProfesseurResource;
use App\Http\Resources\ProfesseurResourceCollection;
use App\Models\Professeur;
use App\Services\ProfesseurService;

class ProfesseurController extends Controller
{     
    public function __construct(private ProfesseurService $professeurService)
    {
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
        $this->professeurService->store($request->validated());
        return response(['success' => 1, 'message' => 'professeur is create'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $professeur = $this->professeurService->getProf($id);
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
    public function update(UpdateProfesseurRequest $request, $id)
    {
        $this->professeurService->update($request->validated(), $id);
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
        $professeur = $this->professeurService->getProf($id);
        $this->professeurService->destroyMatiere($id);
        $professeur->delete();
        return  response(['success' => 1, 'message' => 'professeur is deleted'], 201);
    }
}
