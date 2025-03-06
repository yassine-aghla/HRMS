@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 mb-4 text-center">Cursus de {{ $employe->nom }}</h2>

            <div class="mb-6">
                <h4 class="text-lg font-semibold text-gray-700">Progression du Profil</h4>
                
                <div class="relative flex items-center justify-between w-full">
                    <!-- Étape 1 : Emploi -->
                    <div class="flex flex-col items-center">
                        <p class="text-sm text-gray-400">Emploi</p>
                        <p class="text-sm text-blue-800">{{ $employe->carriere?->emploi?->created_at ?? 'N/A' }}</p>
                        <div class="w-8 h-8 rounded-full flex items-center justify-center 
                            {{ $etapes['emploi'] ? 'bg-green-500' : 'bg-gray-300' }}">
                            1
                        </div>
                        <p class="text-sm">{{ $employe->carriere?->emploi?->name ?? 'Non défini' }}</p>
                    </div>
            
                    <!-- Étape 2 : Formation -->
                    <div class="flex flex-col items-center">
                        <p class="text-sm text-gray-400">Formation</p>
                        <p class="text-sm text-blue-800">{{ $employe->carriere?->formation?->date_debut ?? 'N/A' }}</p>
                        <div class="w-8 h-8 rounded-full flex items-center justify-center 
                            {{ $etapes['formation'] ? 'bg-green-500' : 'bg-gray-300' }}">
                            2
                        </div>
                        <p class="text-sm">{{ $employe->carriere?->formation?->titre ?? 'Non défini' }}</p>
                    </div>

                     <!-- Étape 3 : Contrat -->
                     <div class="flex flex-col items-center">
                        <p class="text-sm text-gray-400">Contrat</p>
                        <p class="text-sm text-blue-800">{{ $employe->carriere?->contrat?->created_at ?? 'N/A' }}</p>
                        <div class="w-8 h-8 rounded-full flex items-center justify-center 
                            {{ $etapes['formation'] ? 'bg-green-500' : 'bg-gray-300' }}">
                            3
                        </div>
                        <p class="text-sm">{{ $employe->carriere?->contrat?->name ?? 'Non défini' }}</p>
                    </div>
            
                    <!-- Étape 4: Grade -->
                    <div class="flex flex-col items-center">
                        <p class="text-sm text-gray-400">Grade</p>
                        <p class="text-sm text-blue-800">{{ $employe->carriere?->grade?->created_at ?? 'N/A' }}</p>
                        <div class="w-8 h-8 rounded-full flex items-center justify-center 
                            {{ $etapes['grade'] ? 'bg-green-500' : 'bg-gray-300' }}">
                            4
                        </div>
                        <p class="text-sm">{{ $employe->carriere?->grade?->name ?? 'Non défini' }}</p>
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
        </div>
    </div>

    <div class="mt-4 flex justify-end space-x-4">
        
        <a href="{{ route('employe.carriere.edit', $employe->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600">
            Gérer le Cursus
        </a>
    </div>

   
@endsection