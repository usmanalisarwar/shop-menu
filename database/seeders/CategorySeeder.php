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
        $appetizers = Category::firstOrCreate(
            ['slug' => 'appetizers'], // Check if this slug already exists
            [
                'name' => 'Appetizers',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => null, // Top-level category
            ]
        );

        $mainCourses = Category::firstOrCreate(
            ['slug' => 'main-courses'], // Check if this slug already exists
            [
                'name' => 'Main Courses',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => null, // Top-level category
            ]
        );

        $desserts = Category::firstOrCreate(
            ['slug' => 'desserts'], // Check if this slug already exists
            [
                'name' => 'Desserts',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => null, // Top-level category
            ]
        );

        $beverages = Category::firstOrCreate(
            ['slug' => 'beverages'], // Check if this slug already exists
            [
                'name' => 'Beverages',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => null, // Top-level category
            ]
        );

        // ----------- SUBCATEGORIES (Second-level) ----------- 
        // Create subcategories under Appetizers
        $soups = Category::firstOrCreate(
            ['slug' => 'soups'], // Check if this slug already exists
            [
                'name' => 'Soups',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => $appetizers->id, // Subcategory of Appetizers
            ]
        );

        $salads = Category::firstOrCreate(
            ['slug' => 'salads'], // Check if this slug already exists
            [
                'name' => 'Salads',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => $appetizers->id, // Subcategory of Appetizers
            ]
        );

        // Create subcategories under Main Courses
        $pasta = Category::firstOrCreate(
            ['slug' => 'pasta'], // Check if this slug already exists
            [
                'name' => 'Pasta',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => $mainCourses->id, // Subcategory of Main Courses
            ]
        );

        $steaks = Category::firstOrCreate(
            ['slug' => 'steaks'], // Check if this slug already exists
            [
                'name' => 'Steaks',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => $mainCourses->id, // Subcategory of Main Courses
            ]
        );

        $seafood = Category::firstOrCreate(
            ['slug' => 'seafood'], // Check if this slug already exists
            [
                'name' => 'Seafood',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => $mainCourses->id, // Subcategory of Main Courses
            ]
        );

        // Create subcategories under Desserts
        $cakes = Category::firstOrCreate(
            ['slug' => 'cakes'], // Check if this slug already exists
            [
                'name' => 'Cakes',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => $desserts->id, // Subcategory of Desserts
            ]
        );

        $iceCream = Category::firstOrCreate(
            ['slug' => 'ice-cream'], // Check if this slug already exists
            [
                'name' => 'Ice Cream',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => $desserts->id, // Subcategory of Desserts
            ]
        );

        // Create subcategories under Beverages
        $softDrinks = Category::firstOrCreate(
            ['slug' => 'soft-drinks'], // Check if this slug already exists
            [
                'name' => 'Soft Drinks',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => $beverages->id, // Subcategory of Beverages
            ]
        );

        $alcoholicDrinks = Category::firstOrCreate(
            ['slug' => 'alcoholic-drinks'], // Check if this slug already exists
            [
                'name' => 'Alcoholic Drinks',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => $beverages->id, // Subcategory of Beverages
            ]
        );

        // ----------- SUB-SUBCATEGORIES (Third-level) ----------- 
        // Create sub-subcategories under Soups
        Category::firstOrCreate(
            ['slug' => 'chicken-soup'], // Check if this slug already exists
            [
                'name' => 'Chicken Soup',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => $soups->id, // Sub-subcategory of Soups
            ]
        );

        Category::firstOrCreate(
            ['slug' => 'vegetable-soup'], // Check if this slug already exists
            [
                'name' => 'Vegetable Soup',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => $soups->id, // Sub-subcategory of Soups
            ]
        );

        // Create sub-subcategories under Salads
        Category::firstOrCreate(
            ['slug' => 'caesar-salad'], // Check if this slug already exists
            [
                'name' => 'Caesar Salad',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => $salads->id, // Sub-subcategory of Salads
            ]
        );

        Category::firstOrCreate(
            ['slug' => 'greek-salad'], // Check if this slug already exists
            [
                'name' => 'Greek Salad',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => $salads->id, // Sub-subcategory of Salads
            ]
        );

        // Create sub-subcategories under Pasta
        Category::firstOrCreate(
            ['slug' => 'spaghetti'], // Check if this slug already exists
            [
                'name' => 'Spaghetti',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => $pasta->id, // Sub-subcategory of Pasta
            ]
        );

        Category::firstOrCreate(
            ['slug' => 'lasagna'], // Check if this slug already exists
            [
                'name' => 'Lasagna',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => $pasta->id, // Sub-subcategory of Pasta
            ]
        );

        // Create sub-subcategories under Steaks
        Category::firstOrCreate(
            ['slug' => 'ribeye'], // Check if this slug already exists
            [
                'name' => 'Ribeye',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => $steaks->id, // Sub-subcategory of Steaks
            ]
        );

        Category::firstOrCreate(
            ['slug' => 'filet-mignon'], // Check if this slug already exists
            [
                'name' => 'Filet Mignon',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => $steaks->id, // Sub-subcategory of Steaks
            ]
        );

        // Create sub-subcategories under Ice Cream
        Category::firstOrCreate(
            ['slug' => 'vanilla'], // Check if this slug already exists
            [
                'name' => 'Vanilla',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => $iceCream->id, // Sub-subcategory of Ice Cream
            ]
        );

        Category::firstOrCreate(
            ['slug' => 'chocolate'], // Check if this slug already exists
            [
                'name' => 'Chocolate',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => $iceCream->id, // Sub-subcategory of Ice Cream
            ]
        );

        // Create sub-subcategories under Soft Drinks
        Category::firstOrCreate(
            ['slug' => 'coca-cola'], // Check if this slug already exists
            [
                'name' => 'Coca-Cola',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => $softDrinks->id, // Sub-subcategory of Soft Drinks
            ]
        );

        Category::firstOrCreate(
            ['slug' => 'pepsi'], // Check if this slug already exists
            [
                'name' => 'Pepsi',
                'status' => 1,
                'user_id' => $user->id,
                'parent_id' => $softDrinks->id, // Sub-subcategory of Soft Drinks
            ]
        );
    }
}