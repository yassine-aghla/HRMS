@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Créer une Formation</h1>
    <form action="{{ route('formations.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('POST')
        <label class="block mb-2">Titre</label>
        <input type="text" name="titre" class="w-full border p-2 rounded" required>
        
        <label class="block mt-4 mb-2">Description</label>
        <textarea name="description" class="w-full border p-2 rounded" required></textarea>
        
        <label class="block mt-4 mb-2">Prix (€)</label>
        <input type="number" name="prix" class="w-full border p-2 rounded" required>
        
        <label class="block mt-4 mb-2">Date de début</label>
        <input type="date" name="date_debut" class="w-full border p-2 rounded" required>

        <label class="block mt-4 mb-2">Niveau</label>
        <select name="niveau" class="block mt-4 mb-2">
            <option value="Debutant">Débutant</option>
            <option value="Intermediaire">Intermédiaire</option>
            <option value="Avance">Avancé</option>
      </select>

      <label class="block mt-4 mb-2">duree</label>
      <input type="number" name="duree" class="w-full border p-2 rounded" required>

        <button type="submit"name="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Créer</button>
    </form>
</div>
@endsection