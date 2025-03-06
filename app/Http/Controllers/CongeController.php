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

    public function create()
    {
        return view('conges.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'date_debut' => 'required|date|after:today',
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

        return redirect()->route('conges.index')->with('success', 'Demande de congé soumise.');
    }

    public function validerManager($id)
    {
        $conge = Conge::findOrFail($id);
       


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
            $conge->save();
            return redirect()->back()->with('success', 'Congé validé par le service RH.');
        }

        return redirect()->back()->withErrors("Cette demande doit d'abord être validée par le manager.");
    }

    public function refuser($id)
    {
        $conge = Conge::findOrFail($id);
        $conge->statut = 'refusé';
        $conge->save();

        return redirect()->back()->with('success', 'Demande de congé refusée.');
    }
}
