@extends('layouts.app')

@section('title', 'Liste des départements')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Liste des Départements</h2>
    @can('department-create')
    <a href="{{ route('departments.create') }}" class="btn btn-primary">+ Ajouter</a>
    @endcan
</div>

<table class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($departments as $department)
        <tr>
            <td>{{ $department->id }}</td>
            <td>{{ $department->name }}</td>
            <td>
                <a href="{{ route('departments.show', $department->id) }}" class="btn btn-info btn-sm">Voir</a>
                {{-- @can('department-edit') --}}
                <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                {{-- @endcan --}}
                {{-- @can('department-delete') --}}
                <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                </form>
                {{-- @endcan --}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
