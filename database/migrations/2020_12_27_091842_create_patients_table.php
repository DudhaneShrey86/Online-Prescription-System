<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('contact');
            $table->longText('history_of_illness');
            $table->longText('history_of_surgery');
            $table->integer('family_is_diabetic')->nullable();
            $table->string('family_allergies', 500)->nullable();
            $table->string('family_others', 500)->nullable();
            $table->string('profile_link')->default('/images/profile-user.png');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
