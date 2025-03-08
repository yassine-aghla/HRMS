@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mes demandes de récupération</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Date de demande</th>
                <th>Jours demandés</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recuperations as $recuperation)
            <tr>
                <td>{{ $recuperation->date_demande }}</td>
                <td>{{ $recuperation->jours_demandes }}</td>
                <td>{{ $recuperation->statut }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('recuperations.create') }}" class="btn btn-primary">Nouvelle demande</a>
</div>
@endsection