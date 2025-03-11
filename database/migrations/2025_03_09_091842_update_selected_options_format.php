<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Update the JSON column format
        DB::table('events')->get()->each(function ($item) {
            if (empty($item->selected_options)) {
                return;
            }

            $jsonData = json_decode($item->selected_options, true);
            if (is_null($jsonData)) {
                return;
            }

            $updatedJsonData = array_map(function ($value) {
                if ($value === 'all') {
                    return [];
                }
                return is_array($value) ? $value : [$value];
            }, $jsonData);

            DB::table('events')
                ->where('id', $item->id)
                ->update(['selected_options' => json_encode($updatedJsonData)]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Revert the JSON column format
        DB::table('events')->get()->each(function ($item) {
            if (empty($item->your_json_column)) {
                return;
            }

            $jsonData = json_decode($item->selected_options, true);
            if (is_null($jsonData)) {
                return;
            }

            $revertedJsonData = array_map(function ($value) {
                if (is_array($value) && count($value) === 0) {
                    return 'all';
                }
                return is_array($value) && count($value) === 1 ? $value[0] : $value;
            }, $jsonData);

            DB::table('events')
                ->where('id', $item->id)
                ->update(['selected_options' => json_encode($revertedJsonData)]);
        });
    }
};
