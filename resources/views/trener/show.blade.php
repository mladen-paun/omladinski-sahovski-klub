@extends('layouts.public')

@section('title', 'Trener Details')

@section('content')
<h1>{{ $trener->ime }} {{ $trener->prezime }}</h1>

<ul class="list-group mb-3">
    <li class="list-group-item"><strong>Broj telefona:</strong> {{ $trener->broj_telefona }}</li>
    <li class="list-group-item"><strong>JMBG:</strong> {{ $trener->jmbg }}</li>
</ul>

<a href="{{ route('trener.index') }}" class="btn btn-primary">Back</a>
<a href="{{ route('trener.edit', $trener) }}" class="btn btn-warning">Edit</a>
@endsection