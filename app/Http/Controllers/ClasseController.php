<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Exceptions\IsExisteExcetion;
use App\Http\Requests\StoreClasseRequest;
use App\Http\Requests\UpdateClasseRequest;
use App\Http\Resources\ClasseResource\ClasseResource;
use App\Http\Resources\ClasseResource\ClasseResourceCollection;
use App\Models\Classe;
use App\Services\ClasseService;

class ClasseController extends Controller
{
    public function __construct(private ClasseService $classeService)
    {
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
        $niveau = $this->classeService->checkniveauexiste($request['niveau_id']);
        if (is_null($niveau)) {
            throw new NotFoundException(['code' => -3, 'message' => ' niveau not found']);
        }

        $classe = $this->classeService->checkClasseNameExiste($request['name']);
        if (isset($classe)) {
            throw new IsExisteExcetion(['code' => -1, 'name' => ' classe']);
        }

        $this->classeService->store($request->validated());
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
        $classe = $this->classeService->checkClasseNotExiste($id);
        if (is_null($classe)) {
            throw new NotFoundException(['code' => -2, 'message' => ' classe not found']);
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
    public function update(UpdateClasseRequest $request, $id)
    {
        $classe = $this->classeService->checkClasseNotExiste($id);
        if (is_null($classe)) {
            throw new NotFoundException(['code' => -3, 'message' => 'classe not found']);
        }
        $niveau = $this->classeService->checkniveauexiste($request['niveau_id']);
        if (is_null($niveau)) {
            throw new NotFoundException(['code' => -3, 'message' => 'niveau not found']);
        }
        $name = $this->classeService->checkClasseNameIDExiste($request['name'], $id);
        if (isset($name)) {
            throw new IsExisteExcetion(['code' => -1, 'name' => 'niveau name']);
        }

        $this->classeService->update($request->validated(), $id, $classe);
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
        $classe = $this->classeService->checkClasseNotExiste($id);
        if (is_null($classe)) {
            throw new NotFoundException(['code' => -3, 'message' => 'classe not found']);
        }
        $classe->delete();
        return response(['success' => 1, 'message' => 'classe is deleted'], 201);
    }
}
