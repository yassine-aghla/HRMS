@extends('layouts.app')

@section('content')
<h2>Demander un congé</h2>

<form method="POST" action="{{ route('conges.store') }}">
    @csrf
    <label>Date début:</label>
    <input type="date" name="date_debut" required>
    
    <label>Date fin:</label>
    <input type="date" name="date_fin" required>
    
    <label>Motif:</label>
    <textarea name="motif" required></textarea>
    
    <button type="submit">Soumettre</button>
</form>
@endsection
