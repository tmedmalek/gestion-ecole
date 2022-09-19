<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Exceptions\IsExisteExcetion;
use App\Http\Requests\StoreEleveRequest;
use App\Http\Requests\UpdateEleveRequest;
use App\Http\Resources\EleveResource;
use App\Http\Resources\EleveResourceCollection;
use App\Models\Eleve;
use App\Services\EleveService;

class EleveController extends Controller
{
    public function __construct(private EleveService $eleveService)
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
        $eleve = $this->eleveService->eleveExiste($request);
        if (isset($eleve)) {
            throw new IsExisteExcetion(['code' => -1, 'name' => ' eleve']);
        }
        $classe = $this->eleveService->classeExiste($request);
        if (is_null($classe)) {
            throw new NotFoundException(['code' => -2, 'message' => ' classe not found ']);
        }
        $parent = $this->eleveService->parentExiste($request);
        if (is_null($parent)) {
            throw new NotFoundException(['code' => -3, 'message' => ' parent not found ']);
        }
        $eleve = Eleve::create($request->validated());
        $eleve->classe()->associate($classe->id);
        $eleve->userParent()->associate($parent->id)->save();
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

        $eleve = $this->eleveService->eleveNOtExiste($id);
        if (is_null($eleve)) {
            throw new NotFoundException(['code' => -1, 'message' => ' eleve not found']);
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
    public function update(UpdateEleveRequest $request, $id)
    {
        $eleve = $this->eleveService->eleveNOtExiste($id);
        if (is_null($eleve)) {
            throw new NotFoundException(['code' => -1, 'message' => ' eleve not found']);
        }
        $classe = $this->eleveService->classeExiste($request);
        if (is_null($classe)) {
            throw new NotFoundException(['code' => -2, 'message' => ' classe not found ']);
        }
        $parent = $this->eleveService->parentExiste($request);
        if (is_null($parent)) {
            throw new NotFoundException(['code' => -3, 'message' => ' parent not found ']);
        }
        $event = $this->eleveService->EventExiste($request);
        if (is_null($event)) {
            throw new NotFoundException(['code' => -4, 'message' => ' event not found ']);
        }
        
        $eleve->update($request->validated());
        $eleve->events()->sync($event->id);
        $eleve->classe()->associate($classe->id);
        $eleve->userParent()->associate($parent->id);
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
        $eleve = $this->eleveService->eleveNOtExiste($id);
        if (is_null($eleve)) {
            throw new NotFoundException(['code' => -1, 'message' => ' eleve not found']);
        }
        $eleve->delete();
        return response(['success' => 1, 'message' => 'eleve is deleted'], 201);
    }
}
