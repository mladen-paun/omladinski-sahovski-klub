@extends('layouts.public')

@section('content')
<h1>Edit Kategorija</h1>

<form action="{{ route('kategorija.update', $kategorija) }}" method="POST">
    @csrf
    @method('PUT')
    @include('kategorija._form')
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('kategorija.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
