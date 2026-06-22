<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CreateDefaultCategories
{
    /**
     * Default categories to create for new users.
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
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        $user = $event->user;

        // Check if user already has categories (prevent duplicate creation)
        if ($user->categories()->exists()) {
            return;
        }

        // Use transaction to ensure all categories are created atomically
        DB::transaction(function () use ($user) {
            // Create income categories
            foreach (self::DEFAULT_CATEGORIES['income'] as $categoryName) {
                Category::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'name' => $categoryName,
                        'type' => 'income',
                    ]
                );
            }

            // Create expense categories
            foreach (self::DEFAULT_CATEGORIES['expense'] as $categoryName) {
                Category::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'name' => $categoryName,
                        'type' => 'expense',
                    ]
                );
            }
        });
    }
}
