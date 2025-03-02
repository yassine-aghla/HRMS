<?php
namespace App\Http\Controllers;

use App\Http\Requests\EmployeRequest;
use App\Models\Employe;
use App\Models\Department;
use App\Models\Contrat;
use App\Models\Formation;
use App\Models\Emploi;
use App\Models\Grade; 
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    
    public function index()
    {
        
        $employees = Employe::with('department', 'Contrat', 'emploi', 'grade', 'formations')->get();

        return view('employes.index', compact('employees'));
    }

    
    public function create()
    {
       
        $departments = Department::all();
        $Contrat = Contrat::all();
        $emplois = Emploi::all(); 
        $grades = Grade::all(); 
        $formations = Formation::all();

        return view('employes.create', compact('departments', 'Contrat', 'emplois', 'grades', 'formations'));
    }

    
    public function store(EmployeRequest $request)
    {
        $employe = new Employe($request->validated());

       
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('employes', 'public');
            $employe->photo = $imagePath;
        }
    
        $employe->save();
    
        
        if ($request->has('formations')) {
            $employe->formations()->sync($request->formations);
        }
    
        return redirect()->route('employes.index')->with('success', 'Employé créé avec succès!');
    }

   
    public function edit($id)
    {
        
        $employe = Employe::with('department', 'Contrat', 'emploi', 'grade', 'formations')->findOrFail($id);

      
        $departments = Department::all();
        $Contrat = Contrat::all();
        $emplois = Emploi::all();
        $grades = Grade::all();
        $formations = Formation::all();

        return view('employes.edit', compact('employe', 'departments', 'Contrat', 'emplois', 'grades', 'formations'));
    }

    
    public function update(EmployeRequest $request, $id)
    {
        $employe = Employe::findOrFail($id);
        $employe->fill($request->validated());
    
        
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('employes', 'public');
            $employe->photo = $imagePath;
        }
    
        $employe->save();
    
        
        if ($request->has('formations')) {
            $employe->formations()->sync($request->formations);
        }
    
        return redirect()->route('employes.index')->with('success', 'Employé mis à jour avec succès!');
    }

    private function calculerEtapes(Employe $employe)
    {
        $etapes = [
            'emploi' => !empty($employe->emploi->name) && !empty($employe->emploi->created_at),
            'contrat' => !empty($employe->contrat->name) && !empty($employe->contrat->created_at),
            'formations' => $employe->formations()->exists(),
            'grade' => !empty($employe->grade->name) && !empty($employe->grade->created_at),
        ];
    
        $etapesRemplies = array_sum($etapes); 
        $totalEtapes = count($etapes); 
        $progression = ($etapesRemplies / $totalEtapes) * 100; 
    
        return [
            'progression' => round($progression), 
            'etapes' => $etapes
        ];
    }
    
    
    public function show($id)
{

    $employe = Employe::with('department', 'Contrat','emploi', 'grade', 'formations')->findOrFail($id);
    $data = $this->calculerEtapes($employe);
    return view('employes.show', [
        'employe' => $employe,
        'progression' => $data['progression'],
        'etapes' => $data['etapes']
    ]);
}

    public function destroy($id)
    {
         $employe = Employe::findOrFail($id);
        $employe->delete();
        return redirect()->route('employes.index')->with('success', 'Employé supprimé avec succès!');
    }
}
