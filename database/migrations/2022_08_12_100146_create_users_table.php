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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('cin')->unique()->nullable();
            $table->string('nationality')->nullable();
            $table->timestamp('date_naissance')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('gouverneant')->nullable();
            $table->integer('zipcode')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('type')->nullable();
            $table->integer('mobile')->nullable();
            $table->date('annee_afectation')->nullable();
            $table->string('diplome')->nullable();
            $table->string('grade')->nullable();
            $table->double('salaire')->nullable();
            $table->string('specialite')->nullable();
            $table->string('matricule')->unique()->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->unsignedBigInteger('classe_id')->nullable();
            $table->foreign('classe_id')->references('id')->on('classes');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
