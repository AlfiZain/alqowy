<?php

namespace Database\Seeders;

use App\Models\SubscribeTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscribeTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        SubscribeTransaction::create([
            'user_id' => 4,
            'total_amount' => 39000,
            'is_paid' => false,
            'proof' => 'proof/resi.png',
            'subscription_start_date' => null,
        ]);
    }
}
