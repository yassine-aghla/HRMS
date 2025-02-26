<?php
namespace App\Http\Controllers;

use App\Http\Requests\FormationRequest;
use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    public function index()
    {
        $formations = Formation::all();
        return view('formations.index', compact('formations'));
    }

    public function create()
    {
        return view('formations.create');
    }

    public function store(FormationRequest $request)
    {
        // var_dump($request);
        // dd($request);
        $formation=Formation::create($request->validated());

        return redirect()->route('formations.index')->with('success', 'Formation créée avec succès.');
    }

    public function show(Formation $formation)
    {
        return view('formations.show', compact('formation'));
    }

    public function edit(Formation $formation)
    {
        return view('formations.edit', compact('formation'));
    }

    public function update(FormationRequest $request, Formation $formation)
    {
        $formation->update($request->validated());
        dd($formation);

        return redirect()->route('formations.index')->with('success', 'Formation mise à jour.');
    }

    public function destroy(Formation $formation)
    {
        $formation->delete();

        return redirect()->route('formations.index')->with('success', 'Formation supprimée.');
    }
}
