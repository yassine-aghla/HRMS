@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Votre solde de congé</h1>
    {{-- {{ dd($soldeConges)}} --}}
    <p>Votre solde de congé disponible est de : <strong>{{ $soldeConges }} jours</strong>.</p>
    <a href="{{ route('conges.index_employe') }}" class="btn btn-primary">Retour à la liste des congés</a>
</div>
@endsection