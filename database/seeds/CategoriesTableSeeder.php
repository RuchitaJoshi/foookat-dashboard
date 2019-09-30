<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [ 'name' => 'Food & Drinks', 'commission' => 5, 'order' => 1, 'active' => 1],
            [ 'name' => 'Fashion', 'commission' => 5, 'order' => 2, 'active' => 1],
            [ 'name' => 'Health & Fitness', 'commission' => 5, 'order' => 3, 'active' => 1],
            [ 'name' => 'Electronics', 'commission' => 5, 'order' => 4, 'active' => 1],
            [ 'name' => 'Groceries', 'commission' => 5, 'order' => 5, 'active' => 1],
            [ 'name' => 'Entertainment', 'commission' => 5, 'order' => 6, 'active' => 1],
            [ 'name' => 'Spas & Saloons', 'commission' => 5, 'order' => 7, 'active' => 1],
            [ 'name' => 'Local Services', 'commission' => 5, 'order' => 8, 'active' => 1],
            [ 'name' => 'Hotels', 'commission' => 5, 'order' => 9, 'active' => 1]
        ];

        foreach ($categories as $category)
        {
            Category::create($category);
        }
    }
}
