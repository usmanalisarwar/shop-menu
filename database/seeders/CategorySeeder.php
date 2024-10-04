<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Create main categories
        $electronics = Category::create(['name' => 'Electronics', 'slug' => 'electronics', 'status' => 1]);
        $fashion = Category::create(['name' => 'Fashion', 'slug' => 'fashion', 'status' => 1]);
        $home = Category::create(['name' => 'Home & Living', 'slug' => 'home-living', 'status' => 1]);

        // Create subcategories for Electronics
        $mobiles = Category::create(['name' => 'Mobiles', 'slug' => 'mobiles', 'status' => 1, 'parent_id' => $electronics->id]);
        $laptops = Category::create(['name' => 'Laptops', 'slug' => 'laptops', 'status' => 1, 'parent_id' => $electronics->id]);

        // Create sub-subcategories for Mobiles
        Category::create(['name' => 'Smartphones', 'slug' => 'smartphones', 'status' => 1, 'parent_id' => $mobiles->id]);
        Category::create(['name' => 'Feature Phones', 'slug' => 'feature-phones', 'status' => 1, 'parent_id' => $mobiles->id]);

        // Create subcategories for Fashion
        $clothing = Category::create(['name' => 'Clothing', 'slug' => 'clothing', 'status' => 1, 'parent_id' => $fashion->id]);
        $footwear = Category::create(['name' => 'Footwear', 'slug' => 'footwear', 'status' => 1, 'parent_id' => $fashion->id]);

        // Create subcategories for Home & Living
        $furniture = Category::create(['name' => 'Furniture', 'slug' => 'furniture', 'status' => 1, 'parent_id' => $home->id]);
        $decor = Category::create(['name' => 'Decor', 'slug' => 'decor', 'status' => 1, 'parent_id' => $home->id]);
    }
}
