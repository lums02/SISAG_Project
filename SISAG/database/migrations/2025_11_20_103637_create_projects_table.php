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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('ministry', 120);
            $table->string('sector')->nullable();
            $table->string('region', 80)->nullable();
            $table->decimal('budget', 15, 2)->nullable();
            $table->enum('status', ['planifie', 'en_cours', 'retard', 'bloque', 'termine'])->default('planifie');
            $table->unsignedTinyInteger('progress')->default(0);
            $table->unsignedTinyInteger('transparency_score')->default(0);
            $table->text('objectives')->nullable();
            $table->text('description')->nullable();
            $table->string('responsable')->nullable();
            $table->string('location')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['ministry', 'region', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
