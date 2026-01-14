@extends('layouts.public')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Lekcije</h1>
    <a href="{{ route('lekcija.create') }}" class="btn btn-primary">Create New</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Naziv</th>
            <th>Deo Partije</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($lekcijas as $lekcija)
        <tr>
            <td>{{ $lekcija->naziv }}</td>
            <td>{{ Str::limit($lekcija->deo_partije, 50) }}</td>
            <td>
                <a href="{{ route('lekcija.show', $lekcija) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('lekcija.edit', $lekcija) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('lekcija.destroy', $lekcija) }}" method="POST" class="d-inline">
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