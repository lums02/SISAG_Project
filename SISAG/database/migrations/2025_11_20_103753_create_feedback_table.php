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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->string('citizen_name')->nullable();
            $table->string('citizen_email')->nullable();
            $table->enum('type', ['feedback', 'vote', 'signalement'])->default('feedback');
            $table->text('comment')->nullable();
            $table->unsignedTinyInteger('score')->nullable();
            $table->json('payload')->nullable();
            $table->string('status')->default('nouveau');
            $table->timestamps();

            $table->index(['project_id', 'type', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
