<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $offices = [
            'Governor\'s Office',
            'Admin',
            'DICT',
            'DILG',
            'DOH',
            'DepEd',
            'DOST',
            'DPWH',
        ];

        foreach ($offices as $office) {
            \App\Models\Office::create([
                'name' => $office,
            ]);
        }
    }
}
