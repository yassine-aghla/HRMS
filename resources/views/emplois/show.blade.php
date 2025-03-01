@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Détails de l'Emploi</h2>
    <div class="card p-4 shadow">
        <p><strong>Nom :</strong> {{ $emploi->name }}</p>
        <p><strong>Département :</strong> {{ $emploi->department->name }}</p>

        <a href="{{ route('emplois.index') }}" class="btn btn-primary px-3 py-1 rounded">Retour</a>

        <form action="{{ route('emplois.destroy', $emploi) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer cet emploi ?')">Supprimer</button>
        </form>
    </div>
</div>
@endsection
