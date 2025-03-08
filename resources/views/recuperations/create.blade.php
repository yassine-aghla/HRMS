@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-semibold mb-6">Nouvelle demande de récupération</h1>

    <!-- Afficher les erreurs de validation -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('recuperations.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="jours_demandes" class="block text-sm font-medium text-gray-700">Jours demandés</label>
            <input 
                type="number" 
                id="jours_demandes" 
                name="jours_demandes" 
                class="w-full px-4 py-2 border rounded-md" 
                value="{{ old('jours_demandes') }}" 
                required
                min="1"
            >
            @error('jours_demandes')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Soumettre la demande</button>
    </form>
</div>
@endsection