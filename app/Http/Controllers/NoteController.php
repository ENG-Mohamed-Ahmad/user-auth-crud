<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Services\NoteService;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $validatedData['user_id'] = $request->user()->id;

        if ($request->ajax()) {
            return response()->json($this->noteService->createNote($validatedData), 201);
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

    public function update(Request $request, Note $note)
    {
        $this->authorize('update', $note);

        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
        ]);

        if ($request->ajax()) {
            return response()->json($this->noteService->updateNote($note, $validatedData));
        }
        return redirect('/notes');
    }

    public function destroy(Request $request, Note $note)
    {
        $this->authorize('delete', $note);
        $this->noteService->deleteNote($note);

        if ($request->ajax()) {
            return response()->json(null, 204);
        }

        return redirect()->back()->with('success', 'Deleted Successfully!');
    }
}
