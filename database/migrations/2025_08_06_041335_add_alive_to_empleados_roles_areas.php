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
        Schema::table('empleados', fn (Blueprint $t) => $t->boolean('alive')->default(true));
        Schema::table('areas', fn (Blueprint $t) => $t->boolean('alive')->default(true));
        Schema::table('roles', fn (Blueprint $t) => $t->boolean('alive')->default(true));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('empleados', function (Blueprint $table) {
            //
        });
    }
};
