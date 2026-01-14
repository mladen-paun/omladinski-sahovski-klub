@extends('layouts.public')

@section('content')
<h1>Create Clan</h1>

<form action="{{ route('clan.store') }}" method="POST">
    @csrf
    @include('clan._form')
    <button type="submit" class="btn btn-success">Save</button>
    <a href="{{ route('clan.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
