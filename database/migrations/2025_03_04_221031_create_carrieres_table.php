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
        Schema::create('carrieres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employe_id')->constrained()->onDelete('cascade');
            $table->foreignId('contrat_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('grade_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('formation_id')->nullable()->constrained()->onDelete('set null');
             $table->foreignId('emploi_id')->nullable()->constrained()->onDelete('set null');
             
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrieres');
    }
};
