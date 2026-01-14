@extends('layouts.public')

@section('content')
<h1>Edit Trener</h1>

<form action="{{ route('trener.update', $trener) }}" method="POST">
    @csrf
    @method('PUT')
    @include('trener._form')
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('trener.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection