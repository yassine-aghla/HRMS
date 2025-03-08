<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;



class Employe extends Model
{
    use HasFactory,HasRoles;

    protected $fillable = ['nom', 'prenom','photo','phone','salaire','contrat_id', 'department_id', 'emploi_id', 'grade_id','user_id','date_embauche',
    'solde_conges','solde_recuperation'];

    protected $guard_name = ["web"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function contrat()
    {
        return $this->belongsTo(Contrat::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function emploi()
    {
        return $this->belongsTo(Emploi::class);
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function formations()
    {
        return $this->belongsToMany(Formation::class, 'employe_formation');
    }
    public function carriere()
    {
        return $this->hasOne(Carriere::class);
    }
    
    public function conges()
    {
        return $this->hasMany(Conge::class);
    }


    public function congesToValidate()
    {
        return $this->hasMany(Conge::class, 'validator_id');
    } 

    public function calculerSoldeConges()
    {
        $dateEmbauche = Carbon::parse($this->date_embauche);
        $aujourdHui = Carbon::now();
        $difference = $dateEmbauche->diffInMonths($aujourdHui);
      
       
        if ($difference < 12) {
            return $difference * 1.5; 
        }

       
        $annees = $dateEmbauche->diffInYears($aujourdHui);
        $solde = 18 + ($annees - 1) * 0.5; 
         return $solde;
    }

    public function mettreAJourSoldeConges()
    {
       
        $this->solde_conges = $this->calculerSoldeConges();
        $this->save();
    }

    public function mettreAJourSoldeRecuperation($jours)
{
    $this->solde_recuperation -= $jours;
    $this->save();
}
    
}
