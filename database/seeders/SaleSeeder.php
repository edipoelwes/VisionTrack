<?php

namespace Database\Seeders;

use App\Models\Installment;
use App\Models\Sale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sale::factory()
            ->count(10)
            ->create()
            ->each(function ($sale) {
                if ($sale->payment_type === 'installment' && $sale->installments_count) {
                    $amount = round($sale->total / $sale->installments_count, 2);
                    for ($i = 1; $i <= $sale->installments_count; $i++) {
                        Installment::query()->create([
                            'sale_id' => $sale->id,
                            'number' => $i,
                            'amount' => $amount,
                            'due_date' => now()->addMonths($i),
                            'paid_at' => null,
                        ]);
                    }
                }
            });
    }
}
