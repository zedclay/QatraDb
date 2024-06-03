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
    Schema::create('donors', function (Blueprint $table) {
        $table->id();
        $table->string('email')->unique();
        $table->string('phone_number');
        $table->string('password');
        $table->string('name');
        $table->string('blood_group');
        $table->date('date_of_birth');
        $table->string('gender');
        $table->string('address');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donors');
    }
};
