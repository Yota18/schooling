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
            $table->integer('nis');
            $table->integer('nisn');
            $table->foreignId('classes_id')->nullable()->constrained('classes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('student_parents_id')->nullable()->constrained('student_parents')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('gender');
            $table->date('birthdate');
            $table->string('birthplace');
            $table->string('phone');
            $table->string('address');
            $table->string('religion');
            $table->string('generation');
            $table->string('alumni');
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
