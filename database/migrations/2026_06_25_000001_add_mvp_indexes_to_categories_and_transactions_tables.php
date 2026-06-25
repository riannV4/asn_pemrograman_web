<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->index(['user_id', 'type'], 'categories_user_id_type_index');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->index(['user_id', 'transaction_date'], 'transactions_user_id_transaction_date_index');
            $table->index(['user_id', 'type', 'transaction_date'], 'transactions_user_id_type_transaction_date_index');
            $table->index(['user_id', 'category_id'], 'transactions_user_id_category_id_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropIndex('transactions_user_id_category_id_index');
            $table->dropIndex('transactions_user_id_type_transaction_date_index');
            $table->dropIndex('transactions_user_id_transaction_date_index');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex('categories_user_id_type_index');
        });
    }
};
