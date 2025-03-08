<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recuperation extends Model
{
    use HasFactory;

    protected $fillable = ['employe_id', 'date_demande', 'jours_demandes', 'statut'];

    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }
}