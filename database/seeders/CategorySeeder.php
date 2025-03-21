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
        // Create main categories for the restaurant menu
        $appetizers = Category::create([
            'name' => 'Appetizers',
            'slug' => 'appetizers',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => null // Top-level category
        ]);

        $mainCourses = Category::create([
            'name' => 'Main Courses',
            'slug' => 'main-courses',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => null // Top-level category
        ]);

        $desserts = Category::create([
            'name' => 'Desserts',
            'slug' => 'desserts',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => null // Top-level category
        ]);

        $beverages = Category::create([
            'name' => 'Beverages',
            'slug' => 'beverages',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => null // Top-level category
        ]);

        // ----------- SUBCATEGORIES (Second-level) ----------- 
        // Create subcategories under Appetizers
        $soups = Category::create([
            'name' => 'Soups',
            'slug' => 'soups',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $appetizers->id // Subcategory of Appetizers
        ]);

        $salads = Category::create([
            'name' => 'Salads',
            'slug' => 'salads',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $appetizers->id // Subcategory of Appetizers
        ]);

        // Create subcategories under Main Courses
        $pasta = Category::create([
            'name' => 'Pasta',
            'slug' => 'pasta',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $mainCourses->id // Subcategory of Main Courses
        ]);

        $steaks = Category::create([
            'name' => 'Steaks',
            'slug' => 'steaks',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $mainCourses->id // Subcategory of Main Courses
        ]);

        $seafood = Category::create([
            'name' => 'Seafood',
            'slug' => 'seafood',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $mainCourses->id // Subcategory of Main Courses
        ]);

        // Create subcategories under Desserts
        $cakes = Category::create([
            'name' => 'Cakes',
            'slug' => 'cakes',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $desserts->id // Subcategory of Desserts
        ]);

        $iceCream = Category::create([
            'name' => 'Ice Cream',
            'slug' => 'ice-cream',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $desserts->id // Subcategory of Desserts
        ]);

        // Create subcategories under Beverages
        $softDrinks = Category::create([
            'name' => 'Soft Drinks',
            'slug' => 'soft-drinks',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $beverages->id // Subcategory of Beverages
        ]);

        $alcoholicDrinks = Category::create([
            'name' => 'Alcoholic Drinks',
            'slug' => 'alcoholic-drinks',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $beverages->id // Subcategory of Beverages
        ]);

        // ----------- SUB-SUBCATEGORIES (Third-level) ----------- 
        // Create sub-subcategories under Soups
        Category::create([
            'name' => 'Chicken Soup',
            'slug' => 'chicken-soup',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $soups->id // Sub-subcategory of Soups
        ]);

        Category::create([
            'name' => 'Vegetable Soup',
            'slug' => 'vegetable-soup',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $soups->id // Sub-subcategory of Soups
        ]);

        // Create sub-subcategories under Salads
        Category::create([
            'name' => 'Caesar Salad',
            'slug' => 'caesar-salad',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $salads->id // Sub-subcategory of Salads
        ]);

        Category::create([
            'name' => 'Greek Salad',
            'slug' => 'greek-salad',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $salads->id // Sub-subcategory of Salads
        ]);

        // Create sub-subcategories under Pasta
        Category::create([
            'name' => 'Spaghetti',
            'slug' => 'spaghetti',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $pasta->id // Sub-subcategory of Pasta
        ]);

        Category::create([
            'name' => 'Lasagna',
            'slug' => 'lasagna',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $pasta->id // Sub-subcategory of Pasta
        ]);

        // Create sub-subcategories under Steaks
        Category::create([
            'name' => 'Ribeye',
            'slug' => 'ribeye',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $steaks->id // Sub-subcategory of Steaks
        ]);

        Category::create([
            'name' => 'Filet Mignon',
            'slug' => 'filet-mignon',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $steaks->id // Sub-subcategory of Steaks
        ]);

        // Create sub-subcategories under Ice Cream
        Category::create([
            'name' => 'Vanilla',
            'slug' => 'vanilla',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $iceCream->id // Sub-subcategory of Ice Cream
        ]);

        Category::create([
            'name' => 'Chocolate',
            'slug' => 'chocolate',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $iceCream->id // Sub-subcategory of Ice Cream
        ]);

        // Create sub-subcategories under Soft Drinks
        Category::create([
            'name' => 'Coca-Cola',
            'slug' => 'coca-cola',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $softDrinks->id // Sub-subcategory of Soft Drinks
        ]);

        Category::create([
            'name' => 'Pepsi',
            'slug' => 'pepsi',
            'status' => 1,
            'user_id' => $user->id,
            'parent_id' => $softDrinks->id // Sub-subcategory of Soft Drinks
        ]);
    }
}
