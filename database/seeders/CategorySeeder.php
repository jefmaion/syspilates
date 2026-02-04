<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category::factory(10)->create();

        Category::create(['name' => 'Mensalidades']);
        Category::create(['name' => 'Material de Limpeza']);
        Category::create(['name' => 'Venda de Produtos']);
        Category::create(['name' => 'Outros']);
    }
}
