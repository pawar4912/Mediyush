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
        Schema::table('carts', function (Blueprint $table) {
            $table->renameColumn('courseid', 'entity_id');
            $table->renameColumn('type', 'entity_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->renameColumn('entity_id', 'courseid');
            $table->renameColumn('entity_type', 'type');
        });
    }
};
