@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 mb-4 text-center">Détails de l'Employé</h2>
            
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
@endsection
