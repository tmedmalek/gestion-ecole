<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Resources\NoteResource;
use App\Http\Resources\NoteResourceCollection;
use App\Models\Note;
use App\Services\NoteService;

class NoteController extends Controller
{
    public function __construct(private NoteService $noteService)
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
        $matiere = $this->noteService->getMatiere($request['matiere_id']);
        if (is_null($matiere)) {
            throw new NotFoundException(['code' => -1, 'message' => 'matiere not found']);
        }
        $eleve = $this->noteService->getEleve($request['eleve_id']);
        if (is_null($eleve)) {
            throw new NotFoundException(['code' => -2, 'message' => 'eleve not found']);
        }
        $note = Note::create($request->validated());
        $note->matiere()->associate($matiere->id);
        $note->eleve()->associate($eleve->id)->save();
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
        $note = $this->noteService->getNote($id);
        if (is_null($note)) {
            throw new NotFoundException(['code' => -3, 'message' => 'note not found']);
        }
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
        $note = $this->noteService->getNote($id);
        if (is_null($note)) {
            throw new NotFoundException(['code' => -3, 'message' => 'note not found']);
        }
        $note->update($request->validated());
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
        $note = $this->noteService->getNote($id);
        if (is_null($note)) {
            throw new NotFoundException(['code' => -3, 'message' => 'note not found']);
        }
        $note->delete();
        return response(['succes' => 1, 'message' => 'note is deleted'], 201);
    }
}
