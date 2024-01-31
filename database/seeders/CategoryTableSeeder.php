<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Category::factory(100)->create();
        // Category::create([
        //     'title' => 'Cloth',
        //     'description' => 'Cloth Description',
        // ]);
        //  Category::create([
        //     'title' => 'Men',
        //     'description' => 'Men Description',
        // ]);
        //  Category::create([
        //     'title' => 'Women',
        //     'description' => 'Men Description',
        // ]);
    }
}
