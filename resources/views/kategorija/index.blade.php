@extends('layouts.public')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Kategorije</h1>
    <a href="{{ route('kategorija.create') }}" class="btn btn-primary">Create New</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Naziv</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kategorijas as $kategorija)
        <tr>
            <td>{{ $kategorija->naziv }}</td>
            <td>
                <a href="{{ route('kategorija.show', $kategorija) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('kategorija.edit', $kategorija) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('kategorija.destroy', $kategorija) }}" method="POST" class="d-inline">
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
