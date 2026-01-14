@extends('layouts.public')

@section('content')
<h1>Create Kategorija</h1>

<form action="{{ route('kategorija.store') }}" method="POST">
    @csrf
    @include('kategorija._form')
    <button type="submit" class="btn btn-success">Save</button>
    <a href="{{ route('kategorija.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
