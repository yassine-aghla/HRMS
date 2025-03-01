<?php
namespace App\Http\Controllers;

use App\Http\Requests\EmployeRequest;
use App\Models\Employe;
use App\Models\Department;
use App\Models\Contrat;
use App\Models\Formation;
use App\Models\Emploi; // Importation de la classe Emploi
use App\Models\Grade; // Importation de la classe Grade
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    // Affiche la liste des employés
    public function index()
    {
        // Récupère tous les employés avec leurs départements, contrats, emplois, grades et formations
        $employees = Employe::with('department', 'Contrat', 'emploi', 'grade', 'formations')->get();

        return view('employes.index', compact('employees'));
    }

    // Affiche le formulaire de création d'un employé
    public function create()
    {
        // Récupère tous les départements, contrats, emplois, grades et formations pour les afficher dans le formulaire
        $departments = Department::all();
        $Contrat = Contrat::all();
        $emplois = Emploi::all(); // Récupère tous les emplois
        $grades = Grade::all(); // Récupère tous les grades
        $formations = Formation::all();

        return view('employes.create', compact('departments', 'Contrat', 'emplois', 'grades', 'formations'));
    }

    // Enregistre un nouvel employé
    public function store(EmployeRequest $request)
    {
        $employe = new Employe($request->validated());

        // Vérifier si un fichier image a été envoyé
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('employes', 'public');
            $employe->photo = $imagePath;
        }
    
        $employe->save();
    
        // Associer les formations si elles existent
        if ($request->has('formations')) {
            $employe->formations()->sync($request->formations);
        }
    
        return redirect()->route('employes.index')->with('success', 'Employé créé avec succès!');
    }

    // Affiche le formulaire d'édition d'un employé
    public function edit($id)
    {
        // Récupère l'employé à éditer, ainsi que ses relations
        $employe = Employe::with('department', 'Contrat', 'emploi', 'grade', 'formations')->findOrFail($id);

        // Récupère tous les départements, contrats, emplois, grades et formations pour les afficher dans le formulaire
        $departments = Department::all();
        $Contrat = Contrat::all();
        $emplois = Emploi::all();
        $grades = Grade::all();
        $formations = Formation::all();

        return view('employes.edit', compact('employe', 'departments', 'Contrat', 'emplois', 'grades', 'formations'));
    }

    // Met à jour les informations d'un employé
    public function update(EmployeRequest $request, $id)
    {
        $employe = Employe::findOrFail($id);
        $employe->fill($request->validated());
    
        // Vérifier si une nouvelle image a été envoyée
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('employes', 'public');
            $employe->photo = $imagePath;
        }
    
        $employe->save();
    
        // Associer les formations si elles existent
        if ($request->has('formations')) {
            $employe->formations()->sync($request->formations);
        }
    
        return redirect()->route('employes.index')->with('success', 'Employé mis à jour avec succès!');
    }
    
    public function show($id)
{

    $employe = Employe::with('department', 'Contrat','emploi', 'grade', 'formations')->findOrFail($id);
    return view('employes.show', compact('employe'));
}

    // Supprime un employé
    public function destroy($id)
    {
        // Récupère l'employé à supprimer
        $employe = Employe::findOrFail($id);

        // Supprime l'employé
        $employe->delete();

        // Redirige vers la page de liste avec un message de succès
        return redirect()->route('employes.index')->with('success', 'Employé supprimé avec succès!');
    }
}
