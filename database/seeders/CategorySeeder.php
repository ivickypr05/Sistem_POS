<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'nama' => 'Material Bangunan',
            ],
            [
                'nama' => 'Material Pipa dan Aksesoris',
            ],
            [
                'nama' => 'Material Pengecatan',
            ],
            [
                'nama' => 'Material Perekat',
            ],
            [
                'nama' => 'Material Elektrikal',
            ],
            [
                'nama' => 'Material Pengamanan',
            ],
            [
                'nama' => 'Material Rumah Tangga',
            ],

        ];

        foreach ($categories as $item) {
            Category::insert([
                'nama' => $item['nama'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
