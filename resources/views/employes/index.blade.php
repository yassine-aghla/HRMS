@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Gestion des Employés</h2>
            <a href="{{ route('employes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Ajouter un Employé</a>
        </div>

        <div class="bg-white p-4 shadow-lg rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Nom</th>
                        <th class="px-4 py-2 text-left">Prenom</th>
                        <th class="px-4 py-2 text-left">Role</th>
                        <th class="px-4 py-2 text-left">Photo</th>
                        
                        <th class="px-4 py-2 text-left">Salaire</th>
                       
                        <th class="px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $employee->nom }}</td>
                            <td class="px-4 py-2">{{ $employee->prenom }}</td>
                            <td class="px-4 py-2">{{ $employee->getRoleNames()->join(', ') }}</td>
                            <td class="px-4 py-2">
                                @if($employee->photo)
                                    <img src="{{ asset('storage/' . $employee->photo) }}" alt="Photo de {{ $employee->nom }}" class="w-16 h-16 object-cover rounded-full">
                                @else
                                    <span>Aucune photo</span>
                                @endif
                            </td>
                           
                            <td class="px-4 py-2">{{ $employee->salaire }}</td>
                        
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('employes.edit', $employee->id) }}" class="text-yellow-500 hover:text-yellow-700">Éditer</a> 
                                <a href="{{ route('employes.show', $employee->id) }}" class="text-blue-500">Voir</a> 
                                <form action="{{ route('employes.destroy', $employee->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
