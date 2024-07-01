<?php
namespace App\Repositories;

use App\Models\Note;

class NoteRepository
{
    public function getUserNotes($userId)
    {
        return Note::where('user_id', $userId)->get();
    }

    public function create(array $data)
    {
        return Note::create($data);
    }

    public function update(Note $note, array $data)
    {
        $note->update($data);
        return $note;
    }

    public function delete(Note $note)
    {
        $note->delete();
    }
}



?>