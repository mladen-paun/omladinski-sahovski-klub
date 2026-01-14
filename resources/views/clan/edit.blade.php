@extends('layouts.public')

@section('content')
<h1>Edit Clan</h1>

<form action="{{ route('clan.update', $clan) }}" method="POST">
    @csrf
    @method('PUT')
    @include('clan._form')
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('clan.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
