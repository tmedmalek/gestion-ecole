<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateMatiereNiveauRequest;
use App\Http\Resources\MatiereNiveauResource;
use App\Http\Resources\MatiereNiveauResourceCollection;
use App\Models\MatiereNiveau;
use App\Services\MatiereNiveauService;


class MatiereNiveauController extends Controller
{
    private $MatiereNiveauService;

    public function __construct(MatiereNiveauService $MatiereNiveauService)
    {
        $this->MatiereNiveauService = $MatiereNiveauService;
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
            'data' => new MatiereNiveauResourceCollection(MatiereNiveau::all())
        ], 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MatiereNiveau $MatiereNiveau)
    {
        return response([
            'success' => 1,
            'data' => new MatiereNiveauResource($MatiereNiveau)
        ], 201);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMatiereNiveauRequest $request, MatiereNiveau $MatiereNiveau)
    {
        $this->MatiereNiveauService->update($request->validated(), $MatiereNiveau);
        return response(['success' => 1, 'message' => 'MatiereNiveau is updated'], 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( MatiereNiveau $MatiereNiveau)
    {
        $MatiereNiveau->delete();
        return response(['success' => 1, 'message' => 'MatiereNiveau is delated'], 201);
    }
}
