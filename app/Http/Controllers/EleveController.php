<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEleveRequest;
use App\Http\Requests\UpdateEleveRequest;
use App\Http\Resources\EleveResource;
use App\Http\Resources\EleveResourceCollection;
use App\Models\Eleve;
use App\Services\EleveService;

class EleveController extends Controller
{
    private $EleveService;

    public function __construct(EleveService $EleveService)
    {
        $this->EleveService = $EleveService;
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
                'data' => new EleveResourceCollection(Eleve::all())
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
    public function store(StoreEleveRequest $request)
    {
        $this->EleveService->store($request->validated());
        return response(['success' => 1, 'message' => 'eleve is create'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $eleve = $this->EleveService->eleveNOtExiste($id);
        return response(
            [
                'success' => 1,
                'data' => new EleveResource($eleve)
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
    public function update(UpdateEleveRequest $request, $id)
    {
        $this->EleveService->update($request->validated(), $id);
        return response(['success' => 1, 'message' => 'Eleve is updated'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eleve = $this->EleveService->eleveNOtExiste($id);
        $eleve->delete();
        return response(['success' => 1, 'message' => 'eleve is deleted'], 201);
    }
}
