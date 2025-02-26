@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Créer un Nouveau Contrat</h2>

    <div class="card p-4 shadow">
        <form action="{{ route('contrats.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nom du Contrat :</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Créer</button>
            <a href="{{ route('contrats.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection
