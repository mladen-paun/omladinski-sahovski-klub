@extends('layouts.public')

@section('title', 'Create Lekcija')

@section('content')
<h1>Create Lekcija</h1>

<form action="{{ route('lekcija.store') }}" method="POST">
    @csrf
    @include('lekcija._form')
    <button type="submit" class="btn btn-success">Save</button>
    <a href="{{ route('lekcija.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection