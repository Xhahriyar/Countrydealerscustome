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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('contact_no');
            $table->string('cnic')->nullable();
            $table->string('father_or_husband_name')->nullable();
            $table->string('client_type')->nullable();
            $table->string('sale_type')->nullable();
            $table->string('plot_size')->nullable();
            $table->string('paid_by')->nullable();
            $table->string('plot_number')->nullable();
            $table->string('address');
            $table->integer('plot_sale_price')->nullable();
            $table->string('vehicles_adjustment')->nullable();
            $table->integer('adjustment_price')->nullable();
            $table->integer('advance_payment')->nullable();
            $table->string('adjustment_product')->nullable();
            $table->date('date');
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
        Schema::dropIfExists('clients');
    }
};
