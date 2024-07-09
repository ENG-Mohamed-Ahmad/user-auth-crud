@extends('layouts.app')

@section('title', 'Edit Note')

@section('content')
<div class="container">
    <h2>Edit Note</h2>
    <form action="{{ route('notes.update', $note) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ $note->title }}" required>
            @if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea id="content" name="content" class="form-control" required>{{ $note->content }}</textarea>
            @if ($errors->has('content'))
                <span class="text-danger">{{ $errors->first('content') }}</span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
