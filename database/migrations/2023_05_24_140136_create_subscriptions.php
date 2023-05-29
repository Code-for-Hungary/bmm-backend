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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email');
            $table->boolean('active')->default(false);
            $table->foreignUuid('event_id')->constrained();
            $table->boolean('confirmed')->default(false);
            $table->timestamp('confirmation_start')->nullable();
            $table->timestamp('confirmation_date')->nullable();
            $table->timestamp('unsubscribe_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
