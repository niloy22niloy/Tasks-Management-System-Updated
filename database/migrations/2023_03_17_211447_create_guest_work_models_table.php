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
        Schema::create('guest_work_models', function (Blueprint $table) {
            $table->id();
            $table->string('Work_Name');
            $table->longText('Work_Description');
            $table->string('Work_Images');
            $table->integer('Created_By');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_work_models');
    }
};
