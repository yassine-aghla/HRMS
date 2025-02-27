<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emploi;
use App\Models\User;
use App\Models\Department;
use App\Models\Contrat;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmplois = Emploi::count();
        $totalUsers = User::count(); 
        $totalDepartments = Department::count();
        $totalContrats = Contrat::count();

        return view('dashboard', compact('totalEmplois', 'totalUsers', 'totalDepartments', 'totalContrats'));
    }
}
