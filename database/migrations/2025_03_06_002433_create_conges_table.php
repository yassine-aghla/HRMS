<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employe_id');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->text('motif')->nullable();
            $table->enum('statut', ['en attente', 'validé_manager', 'validé_rh', 'refusé'])->default('en attente');
            $table->timestamps();

            $table->foreign('employe_id')->references('id')->on('employes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
};
