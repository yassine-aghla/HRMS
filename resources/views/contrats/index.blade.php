@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Liste des Contrats</h2>
        <a href="{{ route('contrats.create') }}" class="btn btn-primary">+ Ajouter un Contrat</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>id</th>
                <th>Nom du Contrat</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contrats as $contrat)
                <tr>
                    <td>{{ $contrat->id }}</td>
                    <td>{{ $contrat->name }}</td>
                    <td>
                        <a href="{{ route('contrats.show', $contrat) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('contrats.edit', $contrat) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('contrats.destroy', $contrat) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer ce contrat ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
