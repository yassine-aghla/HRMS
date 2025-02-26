<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use Illuminate\Http\Request;
use App\Http\Requests\ContratRequest;

class ContratController extends Controller
{
    public function index()
    {
        $contrats = Contrat::all();
        return view('contrats.index', compact('contrats'));
    }

    public function create()
    {
        return view('contrats.create');
    }

    public function store(ContratRequest $request)
    {
        Contrat::create($request->validated());

        return redirect()->route('contrats.index')
                         ->with('success', 'Contrat créé avec succès.');
    }

    public function show(Contrat $contrat)
    {
        return view('contrats.show', compact('contrat'));
    }

    public function edit(Contrat $contrat)
    {
        return view('contrats.edit', compact('contrat'));
    }

    public function update(ContratRequest $request, Contrat $contrat)
    {
        $contrat->update($request->validated());

        return redirect()->route('contrats.index')
                         ->with('success', 'Contrat mis à jour avec succès.');
    }

    public function destroy(Contrat $contrat)
    {
        $contrat->delete();

        return redirect()->route('contrats.index')
                         ->with('success', 'Contrat supprimé avec succès.');
    }
}
