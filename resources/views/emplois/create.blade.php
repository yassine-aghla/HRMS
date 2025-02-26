@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Créer un Emploi</h2>
    <div class="card p-4 shadow">
        <form action="{{ route('emplois.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nom :</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Département :</label>
                <select name="department_id" class="form-control" required>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Créer</button>
            <a href="{{ route('emplois.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection
