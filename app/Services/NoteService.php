<?php

namespace App\Services;

use App\Repositories\NoteRepository;

class NoteService
{
    protected $noteRepo;

    public function __construct(NoteRepository $noteRepo)
    {
        $this->noteRepo = $noteRepo;
    }

    public function getAllNotes($userId)
    {
        return $this->noteRepo->getUserNotes($userId);
    }

    public function createNote(array $data)
    {
        return $this->noteRepo->create($data);
    }

    public function updateNote($note, array $data)
    {
        return $this->noteRepo->update($note, $data);
    }

    public function deleteNote($note)
    {
        return $this->noteRepo->delete($note);
    }
}








?>