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
        Schema::create('category_based_projects', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('project_name');
            $table->integer('added_by');
            $table->integer('priority');
            $table->date('deadline');
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_based_projects');
    }
};
