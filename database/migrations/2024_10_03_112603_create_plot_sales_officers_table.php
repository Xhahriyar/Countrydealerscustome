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
        Schema::create('plot_sales_officers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->foreignId('sales_officer_id')->constrained('sales_officers')->cascadeOnDelete();
            $table->string('commission_type')->nullable();
            $table->integer('commission_amount')->nullable();
            $table->string('commission_received')->nullable();
            $table->string('commission_received_status')->nullable();
            $table->string('paid_by')->nullable();
            $table->date('paid_date')->nullable();
            $table->boolean('is_installment')->default(false)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plot_sales_officers');
    }
};
