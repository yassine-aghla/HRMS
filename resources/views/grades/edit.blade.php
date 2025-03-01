@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Modifier le Grade</h2>

    <form action="{{ route('grades.update', $grade) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nom :</label>
            <input type="text" name="name" class="form-control" value="{{ $grade->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Date de Début :</label>
            <input type="date" name="start_date" class="form-control" value="{{ $grade->start_date }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Date de Fin :</label>
            <input type="date" name="end_date" class="form-control" value="{{ $grade->end_date }}">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('grades.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
