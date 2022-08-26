<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEleveRequest;
use App\Http\Resources\EleveResource;
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
                'data' => EleveResource::collection(Eleve::all())
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
        $eleve =  $this->EleveService->store($request->validated());

        if (is_null($eleve)) {
            return response(['success' => -1, 'message' => 'eleve is existe'], 200);
        }
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
        $eleve = Eleve::firstwhere('id', $id);
        if (is_null($eleve)) {
            return response(['success' => -1, 'message' => 'is not found'], 200);
        }
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
    public function update(StoreEleveRequest $request, $id)
    {
        $eleve =  $this->EleveService->update($request->validated(), $id);
        if (is_null($eleve)) {
            return response(['success' => -1, 'message' => 'is not found'], 200);
        }
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
        $eleve = Eleve::where('id', $id)->first();
        if (is_null($eleve)) {
            return response(['success' => -1, 'message' => 'is not found'], 200);
        }

        $eleve->delete();
        return response(['success' => 1, 'message' => 'eleve is deleted'], 201);
    }
}
