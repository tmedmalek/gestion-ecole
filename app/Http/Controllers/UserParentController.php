<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserParentRequest;
use App\Http\Resources\ProfesseurResource;
use App\Http\Resources\UserParentResource;
use App\Models\UserParent;
use Illuminate\Http\Request;

class UserParentController extends Controller
{
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
                'data' => UserParentResource::collection(UserParent::all())
            ],
            201
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserParentRequest $request)
    {
        $UserParent = UserParent::firstWhere('email', $request->email);

        if (isset($UserParent)) {
            return response(['success' => -1, 'message' => 'UserParent is existe'], 200);
        }

        $UserParent = UserParent::create($request->validated());
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
        $UserParent = UserParent::firstwhere('id', $id);
        if (is_null($UserParent)) {
            return response(['success' => -1, 'message' => 'is not found'], 200);
        }
        return response(
            [
                'success' => 1,
                'data' => new UserParentResource($UserParent)
            ],
            201
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $UserParent = UserParent::where('id', $id)->first();
        if (is_null($UserParent)) {
            return response(['success' => -1, 'message' => 'is not found'], 200);
        }

        $UserParent = UserParent::where('email', $request->email)->first();
        if (isset($UserParent) && $UserParent->id !== $UserParent->id) {
            return response(['success' => -2, 'message' => 'email existe'], 200);
        }

        $UserParent->update(
            'first_name',
            'last_name',
            'date_naissance',
            'type',
            'email',
            'mobile',
            'adresse',
            'cin',
            'annee_afectation',
            'diplome',
            'grade',
            'salaire',
            'specialite',
            'street',
            'city',
            'gouverneant',
            'zipcode',
        );
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

        $UserParent = UserParent::where('id', $id)->first();
        if (is_null($UserParent)) {
            return response(['success' => -1, 'message' => 'is not found'], 200);
        }

        $UserParent->delete();
        return response(['success' => 1, 'message' => 'UserParent is deleted'], 201);
    }
}
