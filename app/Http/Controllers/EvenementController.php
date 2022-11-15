<?php

namespace App\Http\Controllers;

use App\Exceptions\IsExisteExcetion;
use App\Exceptions\NotFoundException;
use App\Http\Requests\StoreEvenementRequest;
use App\Http\Requests\UpdateEvenementRequest;
use App\Http\Resources\EvenementResource;
use App\Http\Resources\EvenementResourceCollection;
use App\Models\Evenement;
use App\Services\EvenementService;

class EvenementController extends Controller
{

    public function __construct(private EvenementService $evenementService)
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
            "succes" => 1,
            "data" => new EvenementResourceCollection(Evenement::all())
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEvenementRequest $request)
    {
        $event = $this->evenementService->checkEventNotExiste($request['name']);
        if (isset($event)) {
            throw new NotFoundException(['code' => -2, 'message' => 'evenement is existe']);
        }
        $this->evenementService->store($request->validated());
        return response(['success' => 1, 'message' => 'Evenement is create'], 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = $this->evenementService->getEvent($id);
        if (is_null($event)) {
            throw new NotFoundException(['code' => -1, 'message' => ' event not found']);
        }
        return response([
            "succes" => 1,
            "data" => new EvenementResource($event)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEvenementRequest $request, $id)
    {

        $event = $this->evenementService->getEvent($id);
        if (is_null($event)) {
            throw new NotFoundException(['code' => -1, 'message' => ' event not found']);
        }
        $event = $this->evenementService->checkNameNotExiste($request['name'], $id);
        if (isset($event)) {
            throw new IsExisteExcetion(['code' => -3, 'name' => 'evenement']);
        }
        $event->update($request->validated());
        return response(['success' => 1, 'message' => 'Evenement is upadeted'], 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = $this->evenementService->getEvent($id);
        $event->delete();
        return response(['success' => 1, 'message' => 'event is deleted'], 201);
    }
}
