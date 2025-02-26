@extends('layouts.app')

@section('title', 'Détails du Département')

@section('content')
<div class="card">
    <div class="card-header">Détails du Département</div>
    <div class="card-body">
        <h4>Nom: {{ $department->name }}</h4>
        <a href="{{ route('departments.index') }}" class="btn btn-primary">Retour</a>
    </div>
</div>
@endsection
