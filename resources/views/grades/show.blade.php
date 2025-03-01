@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Détails du Grade</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nom : {{ $grade->name }}</h5>
            <p class="card-text"><strong>Date de Début :</strong> {{ $grade->start_date }}</p>
            <p class="card-text"><strong>Date de Fin :</strong> {{ $grade->end_date ?? 'En cours' }}</p>

            <a href="{{ route('grades.edit', $grade) }}" class="btn btn-warning">Modifier</a>
            <a href="{{ route('grades.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </div>
</div>
@endsection
