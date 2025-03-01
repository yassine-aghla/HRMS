<?php
namespace App\Http\Controllers;

use App\Models\Emploi;
use App\Models\Department;
use App\Http\Requests\EmploiRequest;


class EmploiController extends Controller
{
    public function index()
    {
        $emplois = Emploi::with('department')->get();
        return view('emplois.index', compact('emplois'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('emplois.create', compact('departments'));
    }

    public function store(EmploiRequest $request)
    {
        Emploi::create($request->validated());

        return redirect()->route('emplois.index')->with('success', 'Emploi créé avec succès.');
    }

    public function show(Emploi $emploi)
    {
        return view('emplois.show', compact('emploi'));
    }

    public function edit(Emploi $emploi)
    {
        $departments = Department::all();
        return view('emplois.edit', compact('emploi', 'departments'));
    }

    public function update(EmploiRequest $request, Emploi $emploi)
    {
        $emploi->update($request->validated());

        return redirect()->route('emplois.index')->with('success', 'Emploi mis à jour avec succès.');
    }

    public function destroy(Emploi $emploi)
    {
        $emploi->delete();

        return redirect()->route('emplois.index')->with('success', 'Emploi supprimé avec succès.');
    }
}
