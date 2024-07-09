<?php

namespace App\Http\Controllers\API;

use App\Models\Note;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Services\NoteService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\NoteResource;
use App\Http\Requests\NoteStoreRequest;

class NoteController extends Controller
{
    use GeneralTrait;

    protected $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    public function index(Request $request)
    {
        $data = NoteResource::collection($this->noteService->getAllNotes($request->user()->id));
        if (count($data)) {
            return $this->successResponseData($data);
        }
        return $this->emptyResponseData();
    }

    public function store(NoteStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['user_id'] = $request->user()->id;
            DB::beginTransaction();
            $newNote = $this->noteService->createNote($validatedData);
            DB::commit();
            $data = new NoteResource($newNote);
            return $this->createdResponseData($data);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create note.'], 500);
        }
    }

    public function show(Note $note)
    {
        try {
            $this->authorize('view', $note);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Note not found or you are not authorized to access it'], 404);
        }
        return new NoteResource($note);
    }

    public function update(Request $request, Note $note)
    {
        try {
            $this->authorize('update', $note);
            $validatedData = $request->validate([
                'title' => 'sometimes|required|string|max:255',
                'content' => 'sometimes|required|string',
            ]);
            DB::beginTransaction();
            $updatedNote = $this->noteService->updateNote($note, $validatedData);
            DB::commit();
            return new NoteResource($updatedNote);
        }catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Server Error: Failed to update note'], 500);
        }
    }

    public function destroy(Note $note)
    {
        try {
            $this->authorize('delete', $note);
            DB::beginTransaction();
            $note->delete();
            DB::commit();
            return response()->json(['message' => 'Note deleted successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to delete note.'], 500);
        }
    }
}