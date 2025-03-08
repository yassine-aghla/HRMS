<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoldeRecuperationToEmployesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('employes', function (Blueprint $table) {
            // Ajoutez la colonne solde_recuperation
            $table->integer('solde_recuperation')->default(0)->after('solde_conges');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employes', function (Blueprint $table) {
            // Supprimez la colonne solde_recuperation en cas de rollback
            $table->dropColumn('solde_recuperation');
        });
    }
}
