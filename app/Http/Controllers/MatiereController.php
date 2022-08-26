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
        $matiere = $this->MatiereService->store($request->validate());
        if (is_null($matiere)) {
            return response(['success' => -1, 'message' => 'matiere is existe'], 200);
        }
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
        $matiere = Matiere::firstwhere('id', $id);
        if (is_null($matiere)) {
            return response(['success' => -1, 'message' => 'is not found'], 200);
        }
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
        $matiere = $this->MatiereService->update($request->validate(), $id);
        if (isset($matiere)) {
            return response(['succes' => -1, 'message' => 'is not existe'], 200);
        }
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

        $matiere = Matiere::where('id', $id)->first();
        if (is_null($matiere)) {
            return response(['success' => -1, 'message' => 'is not found'], 200);
        }

        $matiere->delete();
        return response(['success' => 1, 'message' => 'matiere is deleted'], 201);
    }
}
