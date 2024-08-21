<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('Nom')->nullable();
            $table->string('matricule')->nullable();
            $table->string('Prenoms')->nullable();
            $table->string('Genre')->nullable();
            $table->string('Age')->nullable();
            $table->string('Adresse')->nullable();
            $table->string('email')->nullable();
            $table->string('Niveau')->nullable();
            $table->string('Telephone')->nullable();
            $table->string('upload')->nullable();
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
