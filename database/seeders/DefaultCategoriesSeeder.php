<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;

class DefaultCategoriesSeeder extends Seeder
{
    /**
     * Default categories to create for users.
     */
    private const DEFAULT_CATEGORIES = [
        'income' => [
            'Kiriman Orang Tua',
            'Beasiswa',
            'Gaji',
            'Bonus',
        ],
        'expense' => [
            'Makanan',
            'Transportasi',
            'Kos',
            'Tagihan',
            'Hiburan',
            'Kesehatan',
        ],
    ];

    /**
     * Run the database seeds.
     * 
     * This seeder is useful for:
     * - Adding default categories to existing users who don't have them
     * - Testing purposes
     */
    public function run(): void
    {
        // Get all users who don't have any categories yet
        $usersWithoutCategories = User::doesntHave('categories')->get();

        foreach ($usersWithoutCategories as $user) {
            // Create income categories
            foreach (self::DEFAULT_CATEGORIES['income'] as $categoryName) {
                Category::create([
                    'user_id' => $user->id,
                    'name' => $categoryName,
                    'type' => 'income',
                ]);
            }

            // Create expense categories
            foreach (self::DEFAULT_CATEGORIES['expense'] as $categoryName) {
                Category::create([
                    'user_id' => $user->id,
                    'name' => $categoryName,
                    'type' => 'expense',
                ]);
            }

            $this->command->info("Created default categories for user: {$user->email}");
        }

        if ($usersWithoutCategories->isEmpty()) {
            $this->command->info("All users already have categories.");
        }
    }
}
