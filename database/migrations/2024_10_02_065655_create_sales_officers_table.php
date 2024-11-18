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
        Schema::create('sales_officers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('contact_no');
            $table->string('cnic');
            $table->string('email')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('officer_type')->nullable();
            $table->string('officer_type')->nullable();
            $table->string('designation')->nullable();
            $table->unsignedBigInteger('logged_in_id');
            $table->string('logged_in_name');
            $table->string('ip_address');
            $table->string('user_agent'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_officers');
    }
};
