<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Note;
use Illuminate\Http\Request;

class CheckNoteAccess
{
    public function handle(Request $request, Closure $next)
    {
        $noteId = $request->route('note');

        $note = Note::find($noteId);

        if (!$note || !$request->user()->can('view', $note)) {
            return response()->json(['error' => 'Unauthorized to access this note'], 403);
        }

        return $next($request);
    }
}