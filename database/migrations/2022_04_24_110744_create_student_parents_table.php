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
        Schema::create('student_parents', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('student_id')->nullable()->constrained('students')->onUpdate('cascade')->onDelete('cascade');
            $table->string('father_fullname');
            $table->date('father_birthyear');
            $table->string('father_education');
            $table->string('father_occupation');
            $table->string('father_salary');
            $table->string('mother_fullname');
            $table->date('mother_birthyear');
            $table->string('mother_education');
            $table->string('mother_occupation');
            $table->string('mother_salary');
            $table->string('guardian_fullname') -> nullable();
            $table->date('guardian_birthyear') -> nullable();
            $table->string('guardian_education') -> nullable();
            $table->string('guardian_occupation') -> nullable();
            $table->string('guardian_salary') -> nullable();
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
        Schema::dropIfExists('student_parents');
    }
};
