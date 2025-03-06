<?php
namespace App\Http\Controllers;

use App\Http\Requests\EmployeRequest;
use App\Models\Employe;
use App\Models\Department;
use App\Models\Contrat;
use App\Models\Formation;
use App\Models\Emploi;
use App\Models\Grade; 
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;


class EmployeController extends Controller
{
    
    public function index()
    {
        
        $employees = Employe::with('department', 'Contrat', 'emploi', 'grade', 'formations','user.roles')->get();

        return view('employes.index', compact('employees'));

    }

    
    public function create()
    {
       
        $departments = Department::all();
        $Contrat = Contrat::all();
        $emplois = Emploi::all(); 
        $grades = Grade::all(); 
        $formations = Formation::all();
        $roles = Role::all();

        return view('employes.create', compact('departments', 'Contrat', 'emplois', 'grades', 'formations','roles'));

    }

    
    public function store(EmployeRequest $request)
    {
        $user = User::create([
            'name' => $request->nom . ' ' . $request->prenom,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $employe = new Employe($request->validated());
        $employe->user_id = $user->id;
       
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('employes', 'public');
            $employe->photo = $imagePath;
        }
    
        $employe->save();
    
        
        if ($request->has('formations')) {
            $employe->formations()->sync($request->formations);
        }

         if ($request->has('role')) {
            $role = Role::where('name', $request->role)->first();
        if ($role) {
            $user->assignRole($role);
            
        }
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
    
        $user = $employe->user;
    $user->email = $request->email;
    if ($request->password) {
        $user->password = bcrypt($request->password);
    }
    $user->save();

        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('employes', 'public');
            $employe->photo = $imagePath;
        }
         
        $employe->save();
    
        
        if ($request->has('formations')) {
            $employe->formations()->sync($request->formations);
        }
        
        if ($request->has('role')) {
            $role = Role::where('name', $request->role)->first();
        if ($role) {
            $user->assignRole($role);
            
        }
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
        $employe = Employe::with(['department', 'Contrat', 'emploi', 'grade', 'formations'])->findOrFail($id);
        
        // Récupérer les dernières formations, emplois, contrats et grades
        $emplois = Emploi::all();
        $contrats = Contrat::all();
        $grades = Grade::all();
        $formations = Formation::orderBy('date_debut', 'desc')->get();
    
        // Calculer les étapes pour la barre de progression
        $data = $this->calculerEtapes($employe);
    
        return view('employes.show', [
            'employe' => $employe,
            'progression' => $data['progression'],
            'etapes' => $data['etapes'],
            'emplois' => $emplois,
            'contrats' => $contrats,
            'grades' => $grades,
            'formations' => $formations
        ]);
    }

    public function destroy($id)
    {
         $employe = Employe::findOrFail($id);
        $employe->delete();
        return redirect()->route('employes.index')->with('success', 'Employé supprimé avec succès!');
    }

    public function updatePartielle(Request $request, $id)
{
    // Trouver l'employé
    $employe = Employe::findOrFail($id);

    // Validation des champs reçus dans la requête
    $request->validate([
        'grade_id' => 'nullable|exists:grades,id',
        'emploi_id' => 'nullable|exists:emplois,id',
        'contrat_id' => 'nullable|exists:contrats,id',
        // 'formation_id' => 'nullable|exists:formations,id',
    ]);

    if ($request->has('grade_id')) {
        $employe->grade_id = $request->input('grade_id');
    }

    if ($request->has('emploi_id')) {
        $employe->emploi_id = $request->input('emploi_id');
    }

    if ($request->has('contrat_id')) {
        $employe->contrat_id = $request->input('contrat_id');
    }

    if ($request->has('formation_id')) {
        $employe->formation_id = $request->input('formation_id');
    }

    $employe->save();
    return redirect()->route('employes.show', $employe->id)->with('success', 'Les informations ont été mises à jour avec succès!');
}
 public function organigramme()
{
    
    $employees = Employe::has('user')->with('user.roles', 'department', 'emploi', 'contrat')->get();

  
    $groupedEmployees = [];

    foreach ($employees as $employee) {
        foreach ($employee->user->roles as $role) {
            $groupedEmployees[$role->name][] = $employee;
        }
    }

    return view('employes.organigramme', compact('groupedEmployees'));
}
}
