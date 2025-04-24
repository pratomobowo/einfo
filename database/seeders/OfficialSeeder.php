<?php

namespace Database\Seeders;

use App\Models\Official;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $officials = [
            [
                'name' => 'Prof. Dr. John Doe',
                'position' => 'Rektor',
            ],
            [
                'name' => 'Dr. Jane Smith',
                'position' => 'WR1',
            ],
            [
                'name' => 'Dr. Michael Johnson',
                'position' => 'WR2',
            ],
            [
                'name' => 'Dr. Sarah Williams',
                'position' => 'WR3',
            ],
        ];

        foreach ($officials as $official) {
            Official::create($official);
        }
    }
}
