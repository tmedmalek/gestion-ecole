<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNiveauRequest;
use App\Http\Requests\UpdateNiveauRequest;
use App\Http\Resources\NiveauResource;
use App\Http\Resources\NiveauResourceCollection;
use App\Models\Niveau;
use App\Services\NiveauService;


class NiveauController extends Controller
{

    public function __construct(private NiveauService $niveauService)
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
            'succes' => 1,
            'data' => new NiveauResourceCollection(Niveau::all()),
        ], 201);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNiveauRequest $request)
    {
        $this->niveauService->store($request->validated());
        return response(['succes' => 1, 'data' => 'niveau is created'], 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Niveau = $this->niveauService->getNiveau($id);
        return response([
            'succes' => 1,
            'data' => new NiveauResource($Niveau)
        ], 201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNiveauRequest $request, $id)
    {
        $this->niveauService->update($request->validated(), $id);
        return response(['succes' => 1, 'message' => 'niveau is updated'], 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Niveau = $this->niveauService->getNiveau($id);
        $Niveau->delete();
        return response(['success' => 1, 'message' => 'niveau is deleted'], 201);
    }
}
