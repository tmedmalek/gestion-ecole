<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClasseRequest;
use App\Http\Resources\ClasseResource\ClasseResourceCollection;
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
                'data' => new ClasseResourceCollection(Classe::all())
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
        $this->ClasseService->store($request->validated());
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
        $classe = $this->ClasseService->checkClasseNotExiste($id);
        return response(
            [
                'success' => 1,
                'data' => new ClasseResourceCollection($classe)
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
        $this->ClasseService->update($request->validated(), $id);
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
        $classe = $this->ClasseService->checkClasseNotExiste($id);
        $classe->delete();
        return response(['success' => 1, 'message' => 'classe is deleted'], 201);
    }
}
