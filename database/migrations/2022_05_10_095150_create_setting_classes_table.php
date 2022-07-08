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
        Schema::create('setting_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classes_id')->nullable()->constrained('classes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('subject_id')->nullable()->constrained('subjects')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('setting_classes');
    }
};
