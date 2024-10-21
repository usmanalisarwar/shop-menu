<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\User;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Fetch or create a default user for the seeding process
        $user = User::first(); // Modify this if you want to use a specific user or create a new one

        if (!$user) {
            // If no user is found, create a default user for category seeding
            $user = User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        // ----------- MAIN CATEGORIES (Top-level) -----------
        // Create main categories with no parent_id
        $electronics = Category::create([
            'name' => 'Electronics',
            'slug' => 'electronics',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => null // Top-level category
        ]);

        $fashion = Category::create([
            'name' => 'Fashion',
            'slug' => 'fashion',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => null // Top-level category
        ]);

        $homeLiving = Category::create([
            'name' => 'Home & Living',
            'slug' => 'home-living',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => null // Top-level category
        ]);

        // ----------- SUBCATEGORIES (Second-level) -----------
        // Create subcategories under Electronics
        $mobiles = Category::create([
            'name' => 'Mobiles',
            'slug' => 'mobiles',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $electronics->id // Subcategory of Electronics
        ]);

        $laptops = Category::create([
            'name' => 'Laptops',
            'slug' => 'laptops',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $electronics->id // Subcategory of Electronics
        ]);

        // Create subcategories under Fashion
        $clothing = Category::create([
            'name' => 'Clothing',
            'slug' => 'clothing',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $fashion->id // Subcategory of Fashion
        ]);

        $footwear = Category::create([
            'name' => 'Footwear',
            'slug' => 'footwear',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $fashion->id // Subcategory of Fashion
        ]);

        // Create subcategories under Home & Living
        $furniture = Category::create([
            'name' => 'Furniture',
            'slug' => 'furniture',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $homeLiving->id // Subcategory of Home & Living
        ]);

        $decor = Category::create([
            'name' => 'Decor',
            'slug' => 'decor',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $homeLiving->id // Subcategory of Home & Living
        ]);

        // ----------- SUB-SUBCATEGORIES (Third-level) -----------
        // Create sub-subcategories under Mobiles
        Category::create([
            'name' => 'Smartphones',
            'slug' => 'smartphones',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $mobiles->id // Sub-subcategory of Mobiles
        ]);

        Category::create([
            'name' => 'Feature Phones',
            'slug' => 'feature-phones',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $mobiles->id // Sub-subcategory of Mobiles
        ]);

        // Create sub-subcategories under Clothing
        Category::create([
            'name' => 'Men\'s Clothing',
            'slug' => 'mens-clothing',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $clothing->id // Sub-subcategory of Clothing
        ]);

        Category::create([
            'name' => 'Women\'s Clothing',
            'slug' => 'womens-clothing',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $clothing->id // Sub-subcategory of Clothing
        ]);
    }
}
