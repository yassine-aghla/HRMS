@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Liste des Formations</h1>
    <a href="{{ route('formations.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter une Formation</a>
    <table class="w-full mt-4 border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Titre</th>
                <th class="border px-4 py-2">Prix</th>
                <th class="border px-4 py-2">Date début</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($formations as $formation)
                <tr class="border">
                    <td class="px-4 py-2">{{ $formation->titre }}</td>
                    <td class="px-4 py-2">{{ $formation->prix }} €</td>
                    <td class="px-4 py-2">{{ $formation->date_debut }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('formations.show', $formation) }}" class="text-blue-500">Voir</a>
                        <a href="{{ route('formations.edit', $formation) }}" class="text-yellow-500 mx-2">Modifier</a>
                        <form action="{{ route('formations.destroy', $formation) }}" method="POST" class="inline-block">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection