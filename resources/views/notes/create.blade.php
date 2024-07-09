@extends('layouts.app')

@section('title', 'Create Note')

@section('content')
<div class="container">
    <h2>Create Note</h2>
    <form action="{{ route('notes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{old('title')}}" class="form-control" required>
            @if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea id="content" name="content" value="{{old('content')}}" class="form-control" required></textarea>
            @if ($errors->has('content'))
                <span class="text-danger">{{ $errors->first('content') }}</span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
