<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('plot_sales_officers', function (Blueprint $table) {
            $table->string('paid_by')->nullable();
            $table->date('paid_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plot_sales_officers', function (Blueprint $table) {
            //
        });
    }
};
