<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClasseRequest;
use App\Http\Resources\ClasseResource;
use App\Models\Classe;
use App\Services\ClasseService;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    private $ClasseService;

    public function __construct(ClasseService $ClasseService)
    {
        $this->ClasseService = $ClasseService;
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
                'data' => ClasseResource::collection(Classe::all())
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
    public function store(StoreClasseRequest $request)
    {
        $classe =  $this->ClasseService->store($request->validated());

        if (is_null($classe)) {
            return response(['success' => -1, 'message' => 'classe is existe'], 200);
        }
        return response(['success' => 1, 'message' => 'classe is create'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classe = Classe::firstwhere('id', $id);
        if (is_null($classe)) {
            return response(['success' => -1, 'message' => 'is not found'], 200);
        }
        return response(
            [
                'success' => 1,
                'data' => new ClasseResource($classe)
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
    public function update(Request $request, $id)
    {
        $classe =  $this->ClasseService->update($request->validated(), $id);
        if (is_null($classe)) {
            return response(['success' => -1, 'message' => 'is not found'], 200);
        }
        return response(['success' => 1, 'message' => 'classe is updated'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classe = Classe::where('id', $id)->first();
        if (is_null($classe)) {
            return response(['success' => -1, 'message' => 'is not found'], 200);
        }

        $classe->delete();
        return response(['success' => 1, 'message' => 'classe is deleted'], 201);
    }
}
