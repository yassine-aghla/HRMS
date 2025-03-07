<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateEmployesTableAddDateEmbauche extends Migration
{
    public function up()
    {
        // Ajouter la colonne `date_embauche` avec une valeur par défaut explicite
        Schema::table('employes', function (Blueprint $table) {
            $table->date('date_embauche')->default(now()->toDateString())->after('user_id');
        });

        // Mettre à jour les lignes existantes avec une valeur valide
        DB::table('employes')->whereNull('date_embauche')->update(['date_embauche' => now()->toDateString()]);
    }

    public function down()
    {
        Schema::table('employes', function (Blueprint $table) {
            $table->dropColumn('date_embauche');
        });
    }
}