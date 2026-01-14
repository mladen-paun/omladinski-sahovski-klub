<!-- resources/views/dashboard.blade.php -->
@extends('layouts.public')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Dashboard</h1>
    <p class="lead">Quick access to all sections:</p>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card text-center h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title">Treneri</h5>
                    <p class="card-text">Manage all trainers.</p>
                    <a href="{{ route('trener.index') }}" class="btn btn-primary mt-auto">Go</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title">Clanovi</h5>
                    <p class="card-text">Manage all members.</p>
                    <a href="{{ route('clan.index') }}" class="btn btn-primary mt-auto">Go</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title">Kategorije</h5>
                    <p class="card-text">Manage all categories.</p>
                    <a href="{{ route('kategorija.index') }}" class="btn btn-primary mt-auto">Go</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title">Lekcije</h5>
                    <p class="card-text">Manage all lessons.</p>
                    <a href="{{ route('lekcija.index') }}" class="btn btn-primary mt-auto">Go</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
