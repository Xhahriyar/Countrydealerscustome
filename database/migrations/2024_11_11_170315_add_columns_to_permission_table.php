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
        Schema::table('permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->default(0)->after('id');
            $table->string('label', 128)->after('name');
            $table->boolean('is_visible')->default(true)->after('guard_name');
            $table->integer('sort_order')->default(0)->after('is_visible');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn(['parent_id', 'label', 'is_visible', 'sort_order']);
        });
    }
};
