<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Resources\NoteResource;
use App\Http\Resources\NoteResourceCollection;
use App\Models\Note;
use App\Services\NoteService;

class NoteController extends Controller
{

    private $NoteService;

    public function __construct(NoteService $NoteService)
    {
        $this->NoteService = $NoteService;
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
                'data' => new NoteResourceCollection(Note::all())
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
    public function store(StoreNoteRequest $request)
    {
        $this->NoteService->store($request->validated());
        return response(['succes' => 1, 'data' => 'note is created'], 201);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = $this->NoteService->getNote($id);
        return response([
            'succes' => 1,
            'data' => new NoteResource($note)
        ], 201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNoteRequest $request, $id)
    {
        $this->NoteService->update($request->validated(), $id);
        return response(['succes' => 1, 'message' => 'note is updated'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = $this->NoteService->getNote($id);
        $note->delete();
        return response(['succes' => 1, 'message' => 'note is deleted'], 201);
    }
}
