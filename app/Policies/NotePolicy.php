<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Note;

class NotePolicy
{
    public function view(User $user, Note $note)
    {
        return $user->id === $note->user_id;
    }

    public function update(User $user, Note $note)
    {
        return $user->id === $note->user_id;
    }

    public function delete(User $user, Note $note)
    {
        return $user->id === $note->user_id;
    }
}
