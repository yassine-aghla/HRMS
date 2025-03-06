<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carriere extends Model
{
    use HasFactory;

    protected $fillable = ['employe_id', 'grade_id', 'formation_id', 'emploi_id','contrat_id'];

    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function emploi()
    {
        return $this->belongsTo(Emploi::class);
    }
    public function contrat()
    {
        return $this->belongsTo(Contrat::class);
    }
}
