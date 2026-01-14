@extends('layouts.public')

@section('content')
<h1>{{ $clan->ime }} {{ $clan->prezime }}</h1>

<ul class="list-group mb-3">
    <li class="list-group-item"><strong>Godina rodjenja:</strong> {{ $clan->godina_rodjenja }}</li>
    <li class="list-group-item"><strong>FIDE Rejting:</strong> {{ $clan->fide_rejting }}</li>
    <li class="list-group-item"><strong>Kategorija:</strong> {{ $clan->kategorija->naziv ?? '' }}</li>
</ul>

<a href="{{ route('clan.index') }}" class="btn btn-primary">Back</a>
<a href="{{ route('clan.edit', $clan) }}" class="btn btn-warning">Edit</a>
@endsection
