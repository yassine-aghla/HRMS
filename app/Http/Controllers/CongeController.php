<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conge;
use App\Models\Employe;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class CongeController extends Controller
{
    public function index()
    {
        
        $employe = Auth::User()->employe;
        // echo "<pre>";
        // print_r($employe);
        // echo "<\pre>";
        // die;
        // $user = Auth::user();
    // var_dump($user->HasRole('HR')); 
    // die;

        $conges = Conge::with('employe')->get();
        return view('conges.index', compact('conges'));
    }


    public function index_employe()
{
    $employe = Auth::user()->employe;

    if (!$employe) {
        return redirect()->route('conges.index')->withErrors("Vous n'êtes pas un employé.");
    }

    $conges = Conge::where('employe_id', $employe->id)->get();

    return view('conges.index_employe', compact('conges'));
}



    public function create()
    {
        return view('conges.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'motif' => 'required|string|max:255',
        ]);

        $employe = Auth::User()->employe;
         if (!$employe) {
            return redirect()->back()->withErrors("Vous n'êtes pas un employé.");
        }

        Conge::create([
            'employe_id' => $employe->id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'motif' => $request->motif,
            'statut' => 'en attente',
        ]);
           
       return redirect()->route('conges.index_employe');
            
          
    }

    public function validerManager($id)
    {
        
        $conge = Conge::findOrFail($id);
        $user = Auth::user();


    if ($conge->employe->user->hasRole('Manager')) {
        return redirect()->back()->withErrors("Les managers ne peuvent pas valider les congés d'autres managers.");
    }
        if ($conge->statut !== 'en attente') {
            return redirect()->back()->withErrors("Cette demande ne peut pas être validée par le manager.");
        }

        $conge->statut = 'validé_manager';
        $conge->save();

        return redirect()->back()->with('success', 'Congé validé par le manager.');
    }

   public function validerRH($id)
{
    $conge = Conge::findOrFail($id);

    
    if ($conge->statut === 'validé_manager') {
        $conge->statut = 'validé_rh';
        $employe = $conge->employe;
        $employe->mettreAJourSoldeConges();
        $conge->save();
        return redirect()->back()->with('success', 'Congé validé par le service RH.');
    }

    if ($conge->employe->user->hasRole('Manager') && $conge->statut === 'en attente') {
    //    dd();
        $conge->statut = 'validé_rh';
        $employe = $conge->employe;
        // echo "<pre>";
        // print_r($employe);
        // echo "<\pre>";
        // die;
        $employe->mettreAJourSoldeConges();
        // dd($employe->mettreAJourSoldeConges());
    
        $conge->save();
        return redirect()->back()->with('success', 'Congé validé directement par le service RH.');
    }

    return redirect()->back()->withErrors("Cette demande doit d'abord être validée par le manager.");
}


    public function annuler($id)
{
    $conge = Conge::findOrFail($id);


    if ($conge->statut !== 'en attente') {
        return redirect()->back()->withErrors("Vous ne pouvez annuler qu'un congé en attente.");
    }

    $conge->delete();

    return redirect()->back()->with('success', 'Votre demande de congé a été annulée.');
}

public function refuser($id)
    {
        $conge = Conge::findOrFail($id);
        $conge->statut = 'refusé';
        $conge->save();

        return redirect()->back()->with('success', 'Demande de congé refusée.');
    }



public function soldeConges()
{
    $employe = Auth::user()->employe;
    // var_dump($employe);
    // die;

    if (!$employe) {
        return redirect()->route('conges.index')->withErrors("Vous n'êtes pas un employé.");
    }

    $soldeConges =intval($employe->solde_conges);
    $soldeRecuperation = intval($employe->solde_recuperation);
    return view('conges.solde', compact('soldeConges', 'soldeRecuperation'));
}
}
