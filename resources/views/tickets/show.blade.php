@extends('layouts.app')
@section('content')
<div class="container">
    <header class="ticket-header">
        <h1 class="title">#{{ $ticket->uid }} - {{ $ticket->title }}</h1>
        <span class="status {{ $ticket->status }}">{{ $ticket->status }}</span>
    </header>
    <span class="text-muted">Creado hace {{ timeAgo(strtotime($ticket->created_at)) }}</span>
    <p>Categoría: {{ $ticket->name }}</p>
    <p class="description">Descripción: {{ $ticket->description }}</p>
</div>
@endsection
