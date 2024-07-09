<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Services\NoteService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\NoteStoreRequest;

class NoteController extends Controller
{
    protected $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    public function index(Request $request)
    {
        $notes = $this->noteService->getAllNotes($request->user()->id);
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(NoteStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['user_id'] = $request->user()->id;
            DB::beginTransaction();
            if ($request->ajax()) {
                return response()->json($this->noteService->createNote($validatedData), 201);
            }
            $this->noteService->createNote($validatedData);
            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create note.'], 500);
        }
        return redirect('/notes');
    }

    public function show(Request $request, Note $note)
    {
        $this->authorize('view', $note);
        return view('notes.show', compact('note'));
    }

    public function edit(Note $note)
    {
        $this->authorize('update', $note);
        return view('notes.edit', compact('note'));
    }

    public function update(NoteStoreRequest $request, Note $note)
    {
        try {
            $this->authorize('update', $note);
            $validatedData = $request->validated();
            DB::beginTransaction();
            if ($request->ajax()) {
                return response()->json($this->noteService->updateNote($note, $validatedData));
            }
            $this->noteService->updateNote($note, $validatedData);
            DB::commit();
        }catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Server Error: Failed to update note'], 500);
        }
        return redirect('/notes')->with('success', 'Note Updated Successfully!');
    }

    public function destroy(Request $request, Note $note)
    {
        try {
            $this->authorize('delete', $note);
            DB::beginTransaction();
            $this->noteService->deleteNote($note);
            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to delete note.'], 500);
        }
        if ($request->ajax()) {
            return response()->json(null, 204);
        }
        return redirect()->back()->with('success', 'Deleted Successfully!');
    }
}
