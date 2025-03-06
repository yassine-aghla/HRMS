@extends('layouts.app')

@section('content')
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-blue-500 text-center mb-4">Organigramme de la Société</h1>
        <div class="flex flex-col items-center">
            <!-- Titre pour les HR -->
            <h2 class="text-xl font-bold mb-2">Les RH</h2>
            <!-- HR -->
            @if(isset($groupedEmployees['HR']))
                <div class="flex space-x-8 justify-between">
                    @foreach($groupedEmployees['HR'] as $hr)
                        <div class="flex flex-col items-center bg-blue-600 text-white font-bold py-3 px-6 rounded-lg shadow-md mb-4">
                            <!-- Photo -->
                            @if($hr->photo)
                                <img src="{{ asset('storage/' . $hr->photo) }}" alt="Photo de {{ $hr->nom }}" class="w-16 h-16 object-cover rounded-full mb-2">
                            @else
                                <div class="w-16 h-16 bg-gray-300 rounded-full mb-2 flex items-center justify-center">
                                    <span class="text-gray-500">Pas de photo</span>
                                </div>
                            @endif
                            <!-- Nom et Prénom -->
                            <div>{{ $hr->nom }} {{ $hr->prenom }}</div>
                        </div>
                    @endforeach
                </div>
                <div class="h-10 w-1 bg-gray-500"></div> <!-- Ligne de connexion -->
            @endif

            <!-- Titre pour les Managers -->
            <h2 class="text-xl font-bold mb-2">Les Managers</h2>
            <!-- Managers -->
            @if(isset($groupedEmployees['Manager']))
                <div class="flex space-x-8 mb-4">
                    @foreach($groupedEmployees['Manager'] as $manager)
                        <div class="bg-green-600 text-white font-bold py-3 px-6 rounded-lg shadow-md">
                            <div class="flex flex-col items-center">
                                <!-- Photo -->
                                @if($manager->photo)
                                    <img src="{{ asset('storage/' . $manager->photo) }}" alt="Photo de {{ $manager->nom }}" class="w-16 h-16 object-cover rounded-full mb-2">
                                @else
                                    <div class="w-16 h-16 bg-gray-300 rounded-full mb-2 flex items-center justify-center">
                                        <span class="text-gray-500">Pas de photo</span>
                                    </div>
                                @endif
                                <!-- Nom et Prénom -->
                                <div>{{ $manager->nom }} {{ $manager->prenom }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="h-10 w-1 bg-gray-500"></div> <!-- Ligne de connexion -->
            @endif

            <!-- Titre pour les Employés -->
            <h2 class="text-xl font-bold mb-2">Les Employés</h2>
            <!-- Employés -->
            @if(isset($groupedEmployees['Employé']))
                <div class="flex space-x-4">
                    @foreach($groupedEmployees['Employé'] as $employe)
                        <div class="bg-yellow-500 text-white font-bold py-3 px-6 rounded-lg shadow-md">
                            <div class="flex flex-col items-center">
                                <!-- Photo -->
                                @if($employe->photo)
                                    <img src="{{ asset('storage/' . $employe->photo) }}" alt="Photo de {{ $employe->nom }}" class="w-16 h-16 object-cover rounded-full mb-2">
                                @else
                                    <div class="w-16 h-16 bg-gray-300 rounded-full mb-2 flex items-center justify-center">
                                        <span class="text-gray-500">Pas de photo</span>
                                    </div>
                                @endif
                                <!-- Nom et Prénom -->
                                <div>{{ $employe->nom }} {{ $employe->prenom }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</body>
@endsection