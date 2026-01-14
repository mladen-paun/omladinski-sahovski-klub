@extends('layouts.public')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Clanovi</h1>
    <a href="{{ route('clan.create') }}" class="btn btn-primary">Create New</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Ime</th>
            <th>Prezime</th>
            <th>Godina rodjenja</th>
            <th>FIDE Rejting</th>
            <th>Kategorija</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clans as $clan)
        <tr>
            <td>{{ $clan->ime }}</td>
            <td>{{ $clan->prezime }}</td>
            <td>{{ $clan->godina_rodjenja }}</td>
            <td>{{ $clan->fide_rejting }}</td>
            <td>{{ $clan->kategorija->naziv ?? '' }}</td>
            <td>
                <a href="{{ route('clan.show', $clan) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('clan.edit', $clan) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('clan.destroy', $clan) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
