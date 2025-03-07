@extends('layouts.app')

@section('content')
<h2>Mes Demandes de Congé</h2>

@foreach($conges as $conge)
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Congé du {{ $conge->date_debut }} au {{ $conge->date_fin }}</h5>
        <p><strong>Motif :</strong> {{ $conge->motif }}</p>
        <p><strong>Statut :</strong> {{ $conge->statut }}</p>

        @if($conge->statut == 'en attente')
        <form method="POST" action="{{ route('conges.annuler', $conge->id) }}">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger">Annuler la demande</button>
        </form>
        @endif
    </div>
</div>
@endforeach

@endsection
