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
        Category::create(['title'=>"laravel"]);
        Category::create(['title'=>"programming"]);
        Category::create(['title'=>"php"]);
        Category::create(['title'=>"python"]);
        Category::create(['title'=>"java"]);
        Category::create(['title'=>"Html"]);
       
    }
}