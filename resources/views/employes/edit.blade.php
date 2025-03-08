@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h2 class="text-2xl font-semibold mb-4">Modifier un Employé</h2>
        <form action="{{ route('employes.update', $employe->id) }}" method="POST" class="bg-white p-6 shadow-lg rounded-lg" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom de l'employé</label>
                <input type="text" id="nom" name="nom" class="w-full px-4 py-2 border rounded-md" value="{{ old('nom', $employe->nom) }}" required>
                @error('nom')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom de l'employé</label>
                <input type="text" id="prenom" name="prenom" class="w-full px-4 py-2 border rounded-md" value="{{ old('prenom', $employe->prenom) }}" required>
                @error('prenom')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="contrat_id" class="block text-sm font-medium text-gray-700">Contrat</label>
                <select id="contrat_id" name="contrat_id" class="w-full px-4 py-2 border rounded-md">
                    @foreach ($Contrat as $contract)
                        <option value="{{ $contract->id }}" {{ old('contrat_id', $employe->contrat_id) == $contract->id ? 'selected' : '' }}>{{ $contract->name }}</option>
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
                        <option value="{{ $department->id }}" {{ old('department_id', $employe->department_id) == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
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
                        <option value="{{ $emploi->id }}" {{ old('emploi_id', $employe->emploi_id) == $emploi->id ? 'selected' : '' }}>{{ $emploi->name }}</option>
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
                        <option value="{{ $grade->id }}" {{ old('grade_id', $employe->grade_id) == $grade->id ? 'selected' : '' }}>{{ $grade->name }}</option>
                    @endforeach
                </select>
                @error('grade_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="salaire" class="block text-sm font-medium text-gray-700">Salaire</label>
                <input type="number" id="salaire" name="salaire" class="w-full px-4 py-2 border rounded-md" value="{{ old('salaire', $employe->salaire) }}" required>
                @error('salaire')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                <input type="text" id="phone" name="phone" class="w-full px-4 py-2 border rounded-md" value="{{ old('phone', $employe->phone) }}">
                @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                <input type="file" id="photo" name="photo" class="w-full px-4 py-2 border rounded-md">
                @if ($employe->photo)
                    <img src="{{ asset('storage/' . $employe->photo) }}" alt="Photo de l'employé" class="mt-2 w-32 h-32 rounded-md">
                @endif
                @error('photo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
    <input 
        type="email" 
        id="email" 
        name="email" 
        class="w-full px-4 py-2 border rounded-md" 
        value="{{ old('email', $employe->user->email ?? '') }}" 
        required
    >
    @error('email')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
            
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="w-full px-4 py-2 border rounded-md" 
                    placeholder="Laisser vide"
                >
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="date_embauche" class="block text-sm font-medium text-gray-700">Date d'embauche</label>
                <input type="date" id="date_embauche" name="date_embauche" class="w-full px-4 py-2 border rounded-md" value="{{ old('date_embauche', $employe->date_embauche) }}" required>
                @error('date_embauche')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="solde_recuperation" class="block text-sm font-medium text-gray-700">Jours de récupération</label>
                <input 
                    type="number" 
                    id="solde_recuperation" 
                    name="solde_recuperation" 
                    class="w-full px-4 py-2 border rounded-md" 
                    value="{{ old('solde_recuperation', $employe->solde_recuperation) }}" 
                >
                @error('solde_recuperation')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="formations" class="block text-sm font-medium text-gray-700">Formations</label>
                <select id="formations" name="formations[]" multiple class="w-full px-4 py-2 border rounded-md">
                    @foreach ($formations as $formation)
                        <option value="{{ $formation->id }}" {{ in_array($formation->id, old('formations', $employe->formations->pluck('id')->toArray())) ? 'selected' : '' }}>{{ $formation->titre }}</option>
                    @endforeach
                </select>
                @error('formations')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Modifier l'Employé</button>
        </form>
    </div>
@endsection
