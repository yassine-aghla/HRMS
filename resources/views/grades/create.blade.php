@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Créer un Grade</h2>

    <form action="{{ route('grades.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nom :</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Date de Début :</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Date de Fin :</label>
            <input type="date" name="end_date" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Créer</button>
        <a href="{{ route('grades.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection
