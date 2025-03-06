<?php
namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Carriere;
use App\Models\Formation;
use App\Models\Emploi;
use App\Models\Grade; 
use App\Models\Contrat;
use Illuminate\Http\Request;

class CarriereController extends Controller
{
    public function show($id)
    {
        $employe = Employe::with('carriere')->findOrFail($id);
    
        if (!$employe->carriere) {
            $employe->carriere()->create([
                'emploi_id' => null,
                'formation_id' => null,
                'grade_id' => null,
                'contat_id'=>null,
            ]);
            $employe->load('carriere'); 
        }
    
       
        $etapes = [
            'emploi' => !is_null($employe->carriere->emploi_id),
            'formation' => !is_null($employe->carriere->formation_id),
            'grade' => !is_null($employe->carriere->grade_id),
            'contrat'=>!is_null($employe->carriere->contrat_id),
        ];
    
        $progression = (count(array_filter($etapes)) / count($etapes)) * 100;
    
        return view('employes.carriere', compact('employe', 'etapes', 'progression'));
    }

    public function update(Request $request, $id)
{
    // dd("hjfd");
    $employe = Employe::findOrFail($id);
    $carriere = $employe->carriere ?? new Carriere();
    $carriere->employe_id = $employe->id;
    $carriere->emploi_id = $request->input('emploi_id');
    $carriere->formation_id = $request->input('formation_id');
    $carriere->grade_id = $request->input('grade_id');
    $carriere->contrat_id = $request->input('contrat_id');
    $carriere->save();

    return redirect()->route('employe.carriere', $employe->id)
                     ->with('success', 'Cursus mis à jour avec succès !');
}

public function edit($id)
{
    $employe = Employe::with('carriere')->findOrFail($id);

    
    $emplois = Emploi::all();
    $formations = Formation::all();
    $grades = Grade::all();
    $contrat=Contrat::all();

    return view('employes.edit_carriere', compact('employe', 'emplois', 'formations', 'grades','contrat'));
}
}

