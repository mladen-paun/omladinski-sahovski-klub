@extends('layouts.public')

@section('content')
<h1>Edit Lekcija</h1>

<form action="{{ route('lekcija.update', $lekcija) }}" method="POST">
    @csrf
    @method('PUT')
    @include('lekcija._form')
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('lekcija.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
