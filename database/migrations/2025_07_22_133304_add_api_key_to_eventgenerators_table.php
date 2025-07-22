<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Eventgenerator;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('eventgenerators', function (Blueprint $table) {
            $table->string('api_key')->unique()->nullable();
        });

        // Generate API keys for existing eventgenerators
        $eventgenerators = Eventgenerator::whereNull('api_key')->get();
        
        foreach ($eventgenerators as $eventgenerator) {
            do {
                $apiKey = 'eg_' . Str::random(40);
            } while (Eventgenerator::where('api_key', $apiKey)->exists());
            
            $eventgenerator->update(['api_key' => $apiKey]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eventgenerators', function (Blueprint $table) {
            $table->dropColumn('api_key');
        });
    }
};
