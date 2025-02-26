@extends('layouts.layout')

@section('title', 'Ajouter un Département')

@section('content')
<div class="card">
    <div class="card-header">Ajouter un Département</div>
    <div class="card-body">
        <form action="{{ route('departments.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nom du Département</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Enregistrer</button>
            <a href="{{ route('departments.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection
