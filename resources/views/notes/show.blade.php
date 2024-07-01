@extends('layouts.app')

@section('title', $note->title)

@section('content')
<div class="container">
    <h2>{{ $note->title }}</h2>
    <p>{{ $note->content }}</p>
    <a href="{{ route('notes.edit', $note) }}" class="btn btn-warning btn-sm">Edit</a>
</div>
@endsection