<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emploi;
use App\Models\Employe;
use App\Models\Department;
use App\Models\Contrat;
use App\Models\Formation;
use App\Models\Grade;


class DashboardController extends Controller
{
    public function index()
    {
        $totalEmplois = Emploi::count();
        $totalUsers = Employe::count(); 
        $totalDepartments = Department::count();
        $totalContrats = Contrat::count();
        $totalFormation = Formation::count();
        $totalGrade = Grade::count();


        return view('dashboard', compact('totalEmplois', 'totalUsers', 'totalDepartments', 'totalContrats','totalFormation','totalGrade'));
    }
}
