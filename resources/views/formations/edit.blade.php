@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Modifier la Formation</h1>
    <form action="{{ route('formations.update', $formation->id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf @method('PUT')
        <label class="block mb-2">Titre</label>
        <input type="text" name="titre" value="{{ $formation->titre }}" class="w-full border p-2 rounded" required>
        
        <label class="block mt-4 mb-2">Description</label>
        <textarea name="description" class="w-full border p-2 rounded" required>{{ $formation->description }}</textarea>
        
        <label class="block mt-4 mb-2">Prix (€)</label>
        <input type="number" name="prix" value="{{ $formation->prix }}" class="w-full border p-2 rounded" required>
        
        <label class="block mt-4 mb-2">Date de début</label>
        <input type="date" name="date_debut" value="{{ $formation->date_debut }}" class="w-full border p-2 rounded" required>
        
        <label class="block mt-4 mb-2">Niveau</label>
        <select name="niveau" class="block mt-4 mb-2">
            <option value="Debutant">Débutant</option>
            <option value="Intermediaire">Intermédiaire</option>
            <option value="Avance">Avancé</option>
      </select>

      <label class="block mt-4 mb-2">duree</label>
      <input type="number" name="duree" value="{{ $formation->duree }}" class="w-full border p-2 rounded" required>

        <button type="submit" class="mt-4 bg-yellow-500 text-white px-4 py-2 rounded">Mettre à jour</button>
    </form>
</div>
@endsection
