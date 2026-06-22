<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the test user
        $user = User::where('email', 'test@example.com')->first();

        if (!$user) {
            return;
        }

        // Create expense categories
        $expenseCategories = [
            'Makanan & Minuman',
            'Transportasi',
            'Hiburan',
            'Belanja',
            'Kesehatan',
            'Utilitas',
            'Pendidikan',
        ];

        $categoryModels = [];
        foreach ($expenseCategories as $categoryName) {
            $category = Category::where('user_id', $user->id)
                ->where('name', $categoryName)
                ->first();
            
            if (!$category) {
                $category = Category::create([
                    'user_id' => $user->id,
                    'name' => $categoryName,
                    'type' => 'expense',
                ]);
            }
            
            $categoryModels[$categoryName] = $category;
        }

        // Create income categories
        $incomeCategory = Category::where('user_id', $user->id)
            ->where('name', 'Gaji')
            ->first();
        
        if (!$incomeCategory) {
            $incomeCategory = Category::create([
                'user_id' => $user->id,
                'name' => 'Gaji',
                'type' => 'income',
            ]);
        }

        // Sample transaction data for the current month
        $startOfMonth = Carbon::now()->startOfMonth();
        $now = Carbon::now();

        // Add sample transactions
        $transactions = [
            // Income
            ['type' => 'income', 'amount' => 5000000, 'date' => $startOfMonth, 'category' => $incomeCategory, 'notes' => 'Gaji Bulanan'],
            
            // Expenses this month
            ['type' => 'expense', 'amount' => 50000, 'date' => $startOfMonth->copy()->addDays(2), 'category' => $categoryModels['Makanan & Minuman'], 'notes' => 'Sarapan pagi'],
            ['type' => 'expense', 'amount' => 75000, 'date' => $startOfMonth->copy()->addDays(2), 'category' => $categoryModels['Transportasi'], 'notes' => 'Bensin'],
            ['type' => 'expense', 'amount' => 250000, 'date' => $startOfMonth->copy()->addDays(3), 'category' => $categoryModels['Belanja'], 'notes' => 'Beli kebutuhan rumah'],
            ['type' => 'expense', 'amount' => 100000, 'date' => $startOfMonth->copy()->addDays(3), 'category' => $categoryModels['Makanan & Minuman'], 'notes' => 'Makan siang'],
            ['type' => 'expense', 'amount' => 150000, 'date' => $startOfMonth->copy()->addDays(5), 'category' => $categoryModels['Hiburan'], 'notes' => 'Bioskop'],
            ['type' => 'expense', 'amount' => 80000, 'date' => $startOfMonth->copy()->addDays(5), 'category' => $categoryModels['Transportasi'], 'notes' => 'Ojek online'],
            ['type' => 'expense', 'amount' => 200000, 'date' => $startOfMonth->copy()->addDays(7), 'category' => $categoryModels['Kesehatan'], 'notes' => 'Konsultasi dokter'],
            ['type' => 'expense', 'amount' => 500000, 'date' => $startOfMonth->copy()->addDays(8), 'category' => $categoryModels['Belanja'], 'notes' => 'Beli pakaian'],
            ['type' => 'expense', 'amount' => 120000, 'date' => $startOfMonth->copy()->addDays(10), 'category' => $categoryModels['Makanan & Minuman'], 'notes' => 'Makan malam bersama keluarga'],
            ['type' => 'expense', 'amount' => 90000, 'date' => $startOfMonth->copy()->addDays(12), 'category' => $categoryModels['Utilitas'], 'notes' => 'Tagihan listrik'],
            ['type' => 'expense', 'amount' => 300000, 'date' => $startOfMonth->copy()->addDays(14), 'category' => $categoryModels['Pendidikan'], 'notes' => 'Kursus online'],
            ['type' => 'expense', 'amount' => 60000, 'date' => $startOfMonth->copy()->addDays(15), 'category' => $categoryModels['Makanan & Minuman'], 'notes' => 'Kopi pagi'],
            ['type' => 'expense', 'amount' => 400000, 'date' => $startOfMonth->copy()->addDays(18), 'category' => $categoryModels['Transportasi'], 'notes' => 'Service motor'],
            ['type' => 'expense', 'amount' => 250000, 'date' => $startOfMonth->copy()->addDays(20), 'category' => $categoryModels['Belanja'], 'notes' => 'Beli gadget'],
            ['type' => 'expense', 'amount' => 180000, 'date' => $startOfMonth->copy()->addDays(22), 'category' => $categoryModels['Hiburan'], 'notes' => 'Konser musik'],
            ['type' => 'expense', 'amount' => 120000, 'date' => $startOfMonth->copy()->addDays(25), 'category' => $categoryModels['Makanan & Minuman'], 'notes' => 'Makan dengan teman'],
            ['type' => 'expense', 'amount' => 45000, 'date' => $now, 'category' => $categoryModels['Transportasi'], 'notes' => 'Parkir'],
        ];

        foreach ($transactions as $transaction) {
            $existingTransaction = Transaction::where('user_id', $user->id)
                ->where('notes', $transaction['notes'])
                ->first();
            
            if (!$existingTransaction) {
                Transaction::create([
                    'user_id' => $user->id,
                    'category_id' => $transaction['category']->id,
                    'amount' => $transaction['amount'],
                    'type' => $transaction['type'],
                    'transaction_date' => $transaction['date'],
                    'notes' => $transaction['notes'],
                    'input_method' => 'manual',
                ]);
            }
        }
    }
}
