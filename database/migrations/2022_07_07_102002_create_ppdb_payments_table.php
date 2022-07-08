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
        Schema::create('ppdb_payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_code');
            $table->foreignId('ppdb_registrations_id')->nullable()->constrained('ppdb_registrations')->
            onUpdate('cascade')->onDelete('cascade');
            $table->string('payee');
            $table->string('method');
            $table->date('is_confirmed');
            $table->string('payment_proof');
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
        Schema::dropIfExists('ppdb_payments');
    }
};
