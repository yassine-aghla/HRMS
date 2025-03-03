@extends('layouts.app')

@section('content')
   <h3>Rôle: {{ $employe->getRoleNames()->join(', ') }}</h3>
    <div class="container mx-auto py-8">
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 mb-4 text-center">Détails de l'Employé</h2>
            <div class="mb-6">
                <h4 class="text-lg font-semibold text-gray-700">Progression du Profil</h4>
                
                <div class="relative flex items-center justify-between w-full">
                    <!-- Étape 1 -->
                    <div class="flex flex-col items-center">
                        <p class="text-sm  text-gray-400">Emploi</p>
                        <p class="text-sm  text-blue-800">{{$employe->emploi->created_at}}</p>
                        <div class="w-8 h-8 rounded-full flex items-center justify-center 
                            {{ $etapes['emploi'] ? 'bg-green-500' : 'bg-gray-300' }}">
                            1
                        </div>
                        <p class="text-sm">{{$employe->emploi->name}}</p>
                    </div>
            
                    <!-- Étape 2 -->
                    <div class="flex flex-col items-center">
                        <p class="text-sm  text-gray-400">Contrat</p>
                        <p class="text-sm  text-blue-800">{{$employe->contrat->created_at}}</p>
                        <div class="w-8 h-8 rounded-full flex items-center justify-center 
                            {{ $etapes['emploi'] ? 'bg-green-500' : 'bg-gray-300' }}">
                            2
                        </div>
                        <p class="text-sm">{{$employe->contrat->name}}</p>
                    </div>
            
                    <!-- Étape 3 -->
                    @php
                    $derniereFormation = $employe->formations->last();
                @endphp
                
                @if($derniereFormation)
                    <div class="flex flex-col items-center">
                        <p class="text-sm text-gray-400">Formation</p>
                        <p class="text-sm text-blue-800">{{ $derniereFormation->date_debut }}</p> 
                        <div class="w-8 h-8 rounded-full flex items-center justify-center 
                            {{ $etapes['formations'] ? 'bg-green-500' : 'bg-gray-300' }}">
                            3
                        </div>
                        <p class="text-sm">{{ $derniereFormation->titre }}</p> 
                    </div>
                @else
                    <p class="text-sm text-red-500">Aucune formation enregistrée.</p>
                @endif
            
                    <!-- Étape 4 -->
                    <div class="flex flex-col items-center">
                        <p class="text-sm  text-gray-400">Grade</p>
                        <p class="text-sm  text-blue-800">{{$employe->grade->created_at}}</p>
                        <div class="w-8 h-8 rounded-full flex items-center justify-center 
                            {{ $etapes['emploi'] ? 'bg-green-500' : 'bg-gray-300' }}">
                            2
                        </div>
                        <p class="text-sm">{{$employe->grade->name}}</p>
                    </div>
                </div>
            
                <!-- Barre de progression -->
                <div class="w-full bg-gray-200 rounded-full h-6 mt-4">
                    <div class="bg-blue-600 h-6 rounded-full text-white text-sm flex items-center justify-center"
                        style="width: {{ $progression }}%;">
                        {{ $progression }}%
                    </div>
                </div>
            </div>

            <div class="mt-4 flex justify-end">
                <button id="enrollerButton" class="bg-green-500 text-white px-4 py-2 rounded-md shadow hover:bg-green-600">
                    Enroller
                </button>
            </div>


            <!-- Formulaire de modification caché -->
<div id="modificationForm" class="hidden mt-6 bg-white p-6 rounded-lg shadow-lg">
    <h3 class="text-2xl font-semibold text-gray-700 mb-4">Modifier les informations</h3>

    <form action="{{ route('employes.updatePartielle', $employe->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="emploi" class="block text-sm font-medium text-gray-700">Emploi</label>
            <select id="emploi" name="emploi" class="border border-gray-300 p-2 rounded-md w-full">
                @foreach($emplois as $emploi)
                    <option value="{{ $emploi->id }}" {{ $employe->emploi_id == $emploi->id ? 'selected' : '' }}>
                        {{ $emploi->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="contrat" class="block text-sm font-medium text-gray-700">Contrat</label>
            <select id="contrat" name="contrat" class="border border-gray-300 p-2 rounded-md w-full">
                @foreach($contrats as $contrat)
                    <option value="{{ $contrat->id }}" {{ $employe->contrat_id == $contrat->id ? 'selected' : '' }}>
                        {{ $contrat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="grade" class="block text-sm font-medium text-gray-700">Grade</label>
            <select id="grade" name="grade" class="border border-gray-300 p-2 rounded-md w-full">
                @foreach($grades as $grade)
                    <option value="{{ $grade->id }}" {{ $employe->grade_id == $grade->id ? 'selected' : '' }}>
                        {{ $grade->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="formation" class="block text-sm font-medium text-gray-700">Formation</label>
            <select id="formation" name="formation" class="border border-gray-300 p-2 rounded-md w-full">
                @foreach($formations as $formation)
                    <option value="{{ $formation->id }}" {{ $employe->formation_id == $formation->id ? 'selected' : '' }}>
                        {{ $formation->titre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end mt-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600">
                Sauvegarder
            </button>
        </div>
    </form>
</div>


            <div class="flex items-center space-x-6 mb-6">
                <div>
                    @if ($employe->photo)
                        <img src="{{ asset('storage/' . $employe->photo) }}" alt="Photo de l'employé" class="w-32 h-32 rounded-full shadow-md">
                    @else
                        <div class="w-32 h-32 bg-gray-300 rounded-full flex items-center justify-center text-gray-500">Aucune photo</div>
                    @endif
                </div>
                
                <div>
                    <h3 class="text-2xl font-semibold text-gray-700">{{ $employe->nom }} {{ $employe->prenom }}</h3>
                    <p class="text-gray-600 text-sm">Téléphone : {{ $employe->phone }}</p>
                    <p class="text-gray-600 text-sm">Salaire : <span class="font-semibold">{{ number_format($employe->salaire, 2) }} DH</span></p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-blue-100 p-4 rounded-md shadow-sm">
                    <h4 class="text-lg font-semibold text-blue-700">Contrat</h4>
                    <p class="text-gray-800">{{ $employe->contrat->name }}</p>
                </div>
                <div class="bg-green-100 p-4 rounded-md shadow-sm">
                    <h4 class="text-lg font-semibold text-green-700">Département</h4>
                    <p class="text-gray-800">{{ $employe->department->name }}</p>
                </div>
                <div class="bg-yellow-100 p-4 rounded-md shadow-sm">
                    <h4 class="text-lg font-semibold text-yellow-700">Emploi</h4>
                    <p class="text-gray-800">{{ $employe->emploi->name }}</p>
                </div>
                <div class="bg-purple-100 p-4 rounded-md shadow-sm">
                    <h4 class="text-lg font-semibold text-purple-700">Grade</h4>
                    <p class="text-gray-800">{{ $employe->grade->name }}</p>
                </div>
            </div>

            <div class="mt-6">
                <h4 class="text-xl font-semibold text-gray-700 mb-2">Formations</h4>
                @if($employe->formations->isEmpty())
                    <p class="text-gray-600">Aucune formation suivie.</p>
                @else
                    <ul class="list-disc list-inside bg-gray-100 p-4 rounded-md shadow-md">
                        @foreach($employe->formations as $formation)
                            <li class="text-gray-800">{{ $formation->titre }} ({{ $formation->date_debut }} - {{ $formation->date_fin ?? 'En cours' }})</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="mt-6 flex space-x-4">
                <a href="{{ route('employes.edit', $employe->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600">Modifier</a>
                <form action="{{ route('employes.destroy', $employe->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md shadow hover:bg-red-600">Supprimer</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('enrollerButton').addEventListener('click', function() {
            const form = document.getElementById('modificationForm');
            form.classList.toggle('hidden');
        });
    </script>
@endsection