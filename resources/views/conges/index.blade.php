@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">Demandes de congé</h2>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300 shadow-lg rounded-lg">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="border border-gray-300 px-4 py-2">Employé</th>
                    <th class="border border-gray-300 px-4 py-2">Date début</th>
                    <th class="border border-gray-300 px-4 py-2">Date fin</th>
                    <th class="border border-gray-300 px-4 py-2">Statut</th>
                    @if(auth()->user()->hasRole('Manager') || auth()->user()->hasRole('HR'))
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($conges as $conge)
                <tr class="border border-gray-300 text-center bg-white hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2">{{ $conge->employe->nom }} {{ $conge->employe->prenom }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $conge->date_debut }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $conge->date_fin }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <span class="px-3 py-1 rounded-full text-white
                            @if($conge->statut == 'en attente') bg-yellow-500
                            @elseif($conge->statut == 'validé_manager') bg-blue-500
                            @elseif($conge->statut == 'validé_rh') bg-green-500
                            @else bg-red-500 @endif">
                            {{ $conge->statut }}
                        </span>
                    </td>
                    @if(auth()->user()->hasRole('Manager') || auth()->user()->hasRole('HR'))
                    <td class="border border-gray-300 px-4 py-2 space-x-2">
                        @if($conge->statut == 'en attente' && auth()->user()->hasRole('Manager'))
                        <form method="POST" action="{{ route('conges.validerManager', $conge->id) }}" class="inline">
                            @csrf @method('PATCH')
                            <button type="submit" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                Valider (Manager)
                            </button>
                        </form>
                        @endif

                       @if(($conge->statut == 'validé_manager' || ($conge->employe->user->hasRole('Manager') && $conge->statut == 'en attente')) && auth()->user()->hasRole('HR'))

                        <form method="POST" action="{{ route('conges.validerRH', $conge->id) }}" class="inline">
                            @csrf @method('PATCH')
                            <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 transition">
                                Valider (RH)
                            </button>
                        </form>
                        @endif

                        @if(auth()->user()->hasRole('Manager') || auth()->user()->hasRole('HR'))
                        <form method="POST" action="{{ route('conges.refuser', $conge->id) }}" class="inline">
                            @csrf @method('PATCH')
                            <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                Refuser
                            </button>
                        </form>
                        @endif
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
