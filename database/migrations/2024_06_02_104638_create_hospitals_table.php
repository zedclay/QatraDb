<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('hospitals', function (Blueprint $table) {
        $table->id();
        $table->string('email')->unique();
        $table->string('phone_number');
        $table->string('password');
        $table->string('hospital_name');
        $table->string('hospital_type');
        $table->string('address');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitals');
    }
};
