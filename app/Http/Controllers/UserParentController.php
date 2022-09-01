<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserParentRequest;
use App\Http\Resources\UserParentResource;
use App\Http\Resources\UserParentResourceCollection;
use App\Models\UserParent;
use App\Services\UserParentService;

class UserParentController extends Controller
{

    private $UserParentService;

    public function __construct(UserParentService $UserParentService)
    {
        $this->UserParentService = $UserParentService;
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
                'data' =>new UserParentResourceCollection(UserParent::all())
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
    public function store(StoreUserParentRequest $request)
    {
        $this->UserParentService->store($request->validated());
        return response(['success' => 1, 'message' => 'UserParent is create'], 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parent = $this->getParent($id);
        return response(
            [
                'success' => 1,
                'data' => new UserParentResource($parent)
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
    public function update(StoreUserParentRequest $request, $id)
    {
        $this->UserParentService->update($request->validate(), $id);
        return response(['success' => 1, 'message' => 'parent is updated'], 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parent = $this->getParent($id);
        $parent->delete();
        return response(['success' => 1, 'message' => 'UserParent is deleted'], 201);
    }
}
