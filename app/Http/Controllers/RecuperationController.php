<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recuperation;
use App\Models\Employe;
use Illuminate\Support\Facades\Auth;

class RecuperationController extends Controller
{
    public function index()
    {
        $employe = Auth::user()->employe;
        $recuperations = Recuperation::where('employe_id', $employe->id)->get();
        return view('recuperations.index', compact('recuperations'));
    }

    public function create()
    {
        return view('recuperations.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'jours_demandes' => 'required|integer|min:1',
        ]);
    
       
        $employe = Auth::user()->employe;
    
      
        if (!$employe) {
            return redirect()->back()->withErrors("Vous n'êtes pas un employé.");
        }
    
       
        if ($request->jours_demandes > $employe->solde_recuperation) {
            return redirect()->back()
                             ->withInput() 
                             ->withErrors(['jours_demandes' => 'Vous ne pouvez pas demander plus de jours que votre solde de récupération disponible.']);
        }
    
       
        Recuperation::create([
            'employe_id' => $employe->id,
            'date_demande' => now(),
            'jours_demandes' => $request->jours_demandes,
            'statut' => 'en attente',
        ]);
    
        return redirect()->route('recuperations.index')->with('success', 'Demande de récupération soumise avec succès.');
    }

    public function validerRH($id)
{
    $recuperation = Recuperation::findOrFail($id);
    $recuperation->statut = 'validé';
    $recuperation->save();

    $employe = $recuperation->employe;
    $employe->mettreAJourSoldeRecuperation($recuperation->jours_demandes);

    return redirect()->route('recuperations.index_rh')->with('success', 'La demande de récupération a été validée.');
}

    public function refuser($id)
    {
        $recuperation = Recuperation::findOrFail($id);
        $recuperation->statut = 'refusé';
        $recuperation->save();

        return redirect()->route('recuperations.index_rh')->with('success', 'La demande de récupération a été refusée.');
    }

    public function indexRH()
{
   
    $recuperations = Recuperation::with('employe')->where('statut', 'en attente')->get();

    return view('recuperations.index_rh', compact('recuperations'));
}
}