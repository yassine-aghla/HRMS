@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 mb-4 text-center">Gérer le Cursus de {{ $employe->name }}</h2>

            <form action="{{ route('employe.carriere.update', $employe->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Emploi -->
                <div class="mb-4">
                    <label for="emploi_id" class="block text-sm font-medium text-gray-700">Emploi</label>
                    <select name="emploi_id" id="emploi_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="">Sélectionnez un emploi</option>
                        @foreach($emplois as $emploi)
                            <option value="{{ $emploi->id }}" {{ $employe->carriere->emploi_id == $emploi->id ? 'selected' : '' }}>
                                {{ $emploi->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                 <!-- Contrat -->
                    <div class="mb-4">
                        <label for="contrat_id" class="block text-sm font-medium text-gray-700">Contrat</label>
                        <select id="contrat_id" name="contrat_id" class="w-full px-4 py-2 border rounded-md">
                            @foreach ( $contrat as $contract)
                                <option value="{{ $contract->id }}" {{ $employe->carriere->contrat_id == $emploi->id ? 'selected' : '' }}>
                                    {{ $contract->name }}</option>
                            @endforeach
                        </select>
                </div>

                <!-- Formation -->
                <div class="mb-4">
                    <label for="formation_id" class="block text-sm font-medium text-gray-700">Formation</label>
                    <select name="formation_id" id="formation_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="">Sélectionnez une formation</option>
                        @foreach($formations as $formation)
                            <option value="{{ $formation->id }}" {{ $employe->carriere->formation_id == $formation->id ? 'selected' : '' }}>
                                {{ $formation->titre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Grade -->
                <div class="mb-4">
                    <label for="grade_id" class="block text-sm font-medium text-gray-700">Grade</label>
                    <select name="grade_id" id="grade_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="">Sélectionnez un grade</option>
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}" {{ $employe->carriere->grade_id == $grade->id ? 'selected' : '' }}>
                                {{ $grade->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Bouton de soumission -->
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600">
                        Mettre à jour le Cursus
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection