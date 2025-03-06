@extends('layouts.app')

@section('content')
<h2>Demandes de congé</h2>

<table>
    <tr>
        <th>Employé</th>
        <th>Date début</th>
        <th>Date fin</th>
        <th>Statut</th>
        @if(auth()->user()->hasRole('Manager') && auth()->user()->hasRole('HR'))
        <th>Actions</th>
        @endif
    </tr>
    @foreach($conges as $conge)
    <tr>
        <td>{{ $conge->employe->nom }} {{ $conge->employe->prenom }}</td>
        <td>{{ $conge->date_debut }}</td>
        <td>{{ $conge->date_fin }}</td>
        <td>{{ $conge->statut }}</td>
        <td>
            @if($conge->statut == 'en attente' && auth()->user()->hasRole('Manager'))
                <form method="POST" action="{{ route('conges.validerManager', $conge->id) }}">
                    @csrf @method('PATCH')
                    <button type="submit">Valider (Manager)</button>
                </form>
            @endif

            @if($conge->statut == 'validé_manager' && auth()->user()->hasRole('HR'))
                <form method="POST" action="{{ route('conges.validerRH', $conge->id) }}">
                    @csrf @method('PATCH')
                    <button type="submit">Valider (RH)</button>
                </form>
            @endif
            @if(auth()->user()->hasRole('Manager') || auth()->user()->hasRole('HR'))
            <form method="POST" action="{{ route('conges.refuser', $conge->id) }}">
                @csrf @method('PATCH')
                <button type="submit">Refuser</button>
            </form>
            @endif
        </td>
    </tr>
    @endforeach
</table>
@endsection
