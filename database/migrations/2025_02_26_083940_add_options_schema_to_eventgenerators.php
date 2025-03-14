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
        Schema::table('eventgenerators', function (Blueprint $table) {
            $table->json('options_schema')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eventgenerators', function (Blueprint $table) {
            $table->dropColumn('options_schema');
        });
    }
};
