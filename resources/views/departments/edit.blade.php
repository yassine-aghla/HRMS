@extends('layouts.layout')

@section('title', 'Modifier un Département')

@section('content')
<div class="card">
    <div class="card-header">Modifier le Département</div>
    <div class="card-body">
        <form action="{{ route('departments.update', $department->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nom du Département</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $department->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-warning">Modifier</button>
            <a href="{{ route('departments.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection
