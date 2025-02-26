@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Liste des Emplois</h2>
    <a href="{{ route('emplois.create') }}" class="btn btn-primary mb-3">+ Ajouter un Emploi</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Département</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($emplois as $index => $emploi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $emploi->name }}</td>
                    <td>{{ $emploi->department->name }}</td>
                    <td>
                        <a href="{{ route('emplois.show', $emploi) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('emplois.edit', $emploi) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('emplois.destroy', $emploi) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet emploi ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
