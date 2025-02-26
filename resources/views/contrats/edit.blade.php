@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Modifier le Contrat</h2>

    <div class="card p-4 shadow">
        <form action="{{ route('contrats.update', $contrat) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nom du Contrat :</label>
                <input type="text" name="name" class="form-control" value="{{ $contrat->name }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('contrats.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection
