<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles; 

class Conge extends Model
{
    use HasFactory,HasRoles;

    protected $fillable = ['employe_id', 'date_debut', 'date_fin', 'motif', 'statut'];

    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }

    // Relation avec le validateur 
    // public function validator()
    // {
    //     return $this->belongsTo(Employe::class, 'validator_id');
    // }
}