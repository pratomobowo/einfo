<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Migrate existing data from activities.official_id to activity_officials table
        $activities = DB::table('activities')
            ->whereNotNull('official_id')
            ->select('id', 'official_id')
            ->get();

        foreach ($activities as $activity) {
            DB::table('activity_officials')->insert([
                'activity_id' => $activity->id,
                'official_id' => $activity->official_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Clear the pivot table
        DB::table('activity_officials')->truncate();
    }
};