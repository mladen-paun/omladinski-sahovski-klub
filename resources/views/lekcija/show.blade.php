@extends('layouts.public')

@section('content')
<h1>{{ $lekcija->naziv }}</h1>

<p>{{ $lekcija->deo_partije }}</p>

<a href="{{ route('lekcija.index') }}" class="btn btn-primary">Back</a>
<a href="{{ route('lekcija.edit', $lekcija) }}" class="btn btn-warning">Edit</a>
@endsection
