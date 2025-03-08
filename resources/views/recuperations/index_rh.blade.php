@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-semibold mb-6">Demandes de récupération à valider</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 border-b">Employé</th>
                <th class="px-4 py-2 border-b">Date de demande</th>
                <th class="px-4 py-2 border-b">Jours demandés</th>
                <th class="px-4 py-2 border-b">Statut</th>
                <th class="px-4 py-2 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recuperations as $recuperation)
                <tr>
                    <td class="px-4 py-2 border-b">{{ $recuperation->employe->nom }} {{ $recuperation->employe->prenom }}</td>
                    <td class="px-4 py-2 border-b">
                        {{ \Carbon\Carbon::parse($recuperation->date_demande)->format('d/m/Y') }}
                    </td>
                    <td class="px-4 py-2 border-b">{{ $recuperation->jours_demandes }}</td>
                    <td class="px-4 py-2 border-b">
                        <span class="px-2 py-1 text-sm rounded-full 
                            @if($recuperation->statut === 'en attente') bg-yellow-100 text-yellow-800
                            @elseif($recuperation->statut === 'validé') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ $recuperation->statut }}
                        </span>
                    </td>
                    <td class="px-4 py-2 border-b">
                        @if ($recuperation->statut === 'en attente')
                            <form action="{{ route('recuperations.valider', $recuperation->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Valider</button>
                            </form>
                            <form action="{{ route('recuperations.refuser', $recuperation->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Refuser</button>
                            </form>
                        @else
                            <span class="text-gray-500">Aucune action</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection