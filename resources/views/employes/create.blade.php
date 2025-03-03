@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h2 class="text-2xl font-semibold mb-4">Ajouter un Employé</h2>
        <form action="{{ route('employes.store') }}" method="POST" class="bg-white p-6 shadow-lg rounded-lg" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom de l'employé</label>
                <input type="text" id="nom" name="nom" class="w-full px-4 py-2 border rounded-md" value="{{ old('nom') }}" required>
                @error('nom')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom de l'employé</label>
                <input type="text" id="prenom" name="prenom" class="w-full px-4 py-2 border rounded-md" value="{{ old('prenom') }}" required>
                @error('prenom')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="contrat_id" class="block text-sm font-medium text-gray-700">Contrat</label>
                <select id="contrat_id" name="contrat_id" class="w-full px-4 py-2 border rounded-md">
                    @foreach ($Contrat as $contract)
                        <option value="{{ $contract->id }}" {{ old('contrat_id') == $contract->id ? 'selected' : '' }}>{{ $contract->name }}</option>
                    @endforeach
                </select>
                @error('contrat_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
            <label for="role">Sélectionner un rôle</label>
            <select name="role" class="form-control" required>
    <option value="">-- Sélectionner un rôle --</option>
    @foreach(\Spatie\Permission\Models\Role::all() as $role)
        <option value="{{ $role->name }}">{{ $role->name }}</option>
    @endforeach
</select>
            </div>
            <div class="mb-4">
                <label for="department_id" class="block text-sm font-medium text-gray-700">Département</label>
                <select id="department_id" name="department_id" class="w-full px-4 py-2 border rounded-md">
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                    @endforeach
                </select>
                @error('department_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="emploi_id" class="block text-sm font-medium text-gray-700">Emploi</label>
                <select id="emploi_id" name="emploi_id" class="w-full px-4 py-2 border rounded-md">
                    @foreach ($emplois as $emploi)
                        <option value="{{ $emploi->id }}" {{ old('emploi_id') == $emploi->id ? 'selected' : '' }}>{{ $emploi->name }}</option>
                    @endforeach
                </select>
                @error('emploi_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="grade_id" class="block text-sm font-medium text-gray-700">Grade</label>
                <select id="grade_id" name="grade_id" class="w-full px-4 py-2 border rounded-md">
                    @foreach ($grades as $grade)
                        <option value="{{ $grade->id }}" {{ old('grade_id') == $grade->id ? 'selected' : '' }}>{{ $grade->name }}</option>
                    @endforeach
                </select>
                @error('grade_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="salaire" class="block text-sm font-medium text-gray-700">Salaire</label>
                <input type="number" id="salaire" name="salaire" class="w-full px-4 py-2 border rounded-md" value="{{ old('salaire') }}" required>
                @error('salaire')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                <input type="text" id="phone" name="phone" class="w-full px-4 py-2 border rounded-md" value="{{ old('phone') }}">
                @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                <input type="file" id="photo" name="photo" class="w-full px-4 py-2 border rounded-md">
                @error('photo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="formations" class="block text-sm font-medium text-gray-700">Formations</label>
                <select id="formations" name="formations[]" multiple class="w-full px-4 py-2 border rounded-md">
                    @foreach ($formations as $formation)
                        <option value="{{ $formation->id }}" {{ in_array($formation->id, old('formations', [])) ? 'selected' : '' }}>{{ $formation->titre }}</option>
                    @endforeach
                </select>
                @error('formations')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Créer l'Employé</button>
        </form>
    </div>
@endsection
