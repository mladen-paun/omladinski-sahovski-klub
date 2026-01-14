@extends('layouts.public')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Treneri</h1>
    <a href="{{ route('trener.create') }}" class="btn btn-primary">Create New</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Ime</th>
            <th>Prezime</th>
            <th>Broj telefona</th>
            <th>JMBG</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($treners as $trener)
        <tr>
            <td>{{ $trener->ime }}</td>
            <td>{{ $trener->prezime }}</td>
            <td>{{ $trener->broj_telefona }}</td>
            <td>{{ $trener->jmbg }}</td>
            <td>
                <a href="{{ route('trener.show', $trener) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('trener.edit', $trener) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('trener.destroy', $trener) }}" method="POST" class="d-inline">
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
