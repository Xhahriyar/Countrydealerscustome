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
        Schema::create('purchase_plot_installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('purchases')->cascadeOnDelete();
            $table->string('code');
            $table->string('payment_type')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('status')->nullable();
            $table->string('cheque_image')->nullable();
            $table->string('cheque_installment_amount')->nullable();
            $table->dateTime('cheque_installment_due_date')->nullable();
            $table->string('installment_payment')->nullable();
            $table->dateTime('payment_installment_due_date')->nullable();
            $table->string('receipt_image')->nullable();
            $table->date('date')->nullable();
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
        Schema::dropIfExists('purchase_plot_installments');
    }
};
