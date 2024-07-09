@extends('layouts.app')

@section('title', 'Notes')

@section('content')
<div class="container">
    <h2>My Notes</h2>
    <a href="{{ route('notes.create') }}" class="btn btn-primary mb-3">Create New Note</a>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notes as $note)
                <tr>
                    <td>{{ $note->title }}</td>
                    <td>
                        <a href="{{ route('notes.show', $note) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('notes.edit', $note) }}" class="btn btn-warning btn-sm">Edit</a>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $note->id }}">Delete</button>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $note->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $note->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $note->id }}">Delete Note</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this note?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="{{ route('notes.destroy', $note) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Delete Modal -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
