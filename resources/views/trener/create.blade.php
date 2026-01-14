@extends('layouts.public')

@section('content')
<h1>Create Trener</h1>

<form action="{{ route('trener.store') }}" method="POST">
    @csrf
    @include('trener._form')
    <button type="submit" class="btn btn-success">Save</button>
    <a href="{{ route('trener.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
