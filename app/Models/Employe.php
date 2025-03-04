<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employe extends Model
{
    use HasFactory,HasRoles;

    protected $fillable = ['nom', 'prenom','photo','phone','salaire', 'contrat_id', 'department_id', 'emploi_id', 'grade_id','user_id'];

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
    
}
