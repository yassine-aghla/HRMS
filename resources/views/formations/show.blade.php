@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold">{{ $formation->titre }}</h1>
    <p class="mt-2 text-gray-600">{{ $formation->description }}</p>
    <p class="mt-2 font-bold">Prix : {{ $formation->prix }} €</p>
    <p class="mt-2">Date de début : {{ $formation->date_debut }}</p>
    <a href="{{ route('formations.index') }}" class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded">Retour</a>
</div>
@endsection