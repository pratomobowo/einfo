<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Official;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $officials = Official::all();
        $activities = [];

        foreach ($officials as $official) {
            for ($i = 1; $i <= 3; $i++) {
                $activities[] = [
                    'official_id' => $official->id,
                    'title' => "Kegiatan {$official->position} {$i}",
                    'description' => "Deskripsi kegiatan {$official->position} {$i}",
                    'date' => now()->addDays($i),
                    'time' => '09:00',
                    'location' => "Ruang {$official->position}",
                ];
            }
        }

        foreach ($activities as $activity) {
            Activity::create($activity);
        }
    }
}
