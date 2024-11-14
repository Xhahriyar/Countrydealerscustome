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
        Schema::table('plot_sales_officers', function (Blueprint $table) {
            $table->string('commission_received')->nullable();
            $table->string('commission_received_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plot_sales_officers', function (Blueprint $table) {
            $table->dropColumn('commission_received');
            $table->dropColumn('commission_received_status');
        });
    }
};
