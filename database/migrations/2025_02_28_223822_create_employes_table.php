<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('photo')->nullable();
            $table->string('phone')->nullable();
            $table->decimal('salaire', 10, 2);
            $table->unsignedBigInteger('contrat_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('emploi_id');
            $table->unsignedBigInteger('grade_id');
            $table->timestamps();
            $table->foreign('contrat_id')->references('id')->on('contrats')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('emploi_id')->references('id')->on('emplois')->onDelete('cascade');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
        });
        Schema::create('employe_formation', function (Blueprint $table) {
            $table->unsignedBigInteger('employe_id');
            $table->unsignedBigInteger('formation_id');
            $table->timestamps();
            $table->foreign('employe_id')->references('id')->on('employes')->onDelete('cascade');
            $table->foreign('formation_id')->references('id')->on('formations')->onDelete('cascade');
            $table->primary(['employe_id', 'formation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employe_formation');
        Schema::dropIfExists('employes');
    }
};
