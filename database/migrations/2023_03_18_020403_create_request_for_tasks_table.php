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
        Schema::create('request_for_tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('category_based_project_id');
            $table->string('request_to');
            $table->string('request_by');
            $table->integer('status');
            $table->integer('compelete')->nullable();
            $table->integer('checking')->nullable();
            $table->integer('exist')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_for_tasks');
    }
};
