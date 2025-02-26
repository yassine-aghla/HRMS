@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow">
        <h2>Contrat : {{ $contrat->name }}</h2>
        <a href="{{ route('contrats.index') }}" class="btn btn-secondary mt-3">Retour</a>
    </div>
</div>
@endsection
