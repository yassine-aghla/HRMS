@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Liste des Grades</h2>
    <a href="{{ route('grades.create') }}" class="btn btn-primary mb-3">Créer un Grade</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nom</th>
                <th>Date de Début</th>
                <th>Date de Fin</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grades as $grade)
                <tr>
                    <td>{{ $grade->name }}</td>
                    <td>{{ $grade->start_date }}</td>
                    <td>{{ $grade->end_date ?? 'En cours' }}</td>
                    <td>
                        <a href="{{ route('grades.show', $grade) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('grades.edit', $grade) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('grades.destroy', $grade) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
