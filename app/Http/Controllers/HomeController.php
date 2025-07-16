<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Installment;
use App\Models\Sale;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        return Inertia::render('Dashboard', [
            'total_clients' => Client::query()->count(),
            'total_sales' => Sale::query()->count(),
            'total_sales_month' => Sale::query()->whereMonth('sold_at', now()->month)->sum('total'),
            'total_revenue' => Sale::query()->sum('total'),
            'pending_installments' => Installment::query()->whereNull('paid_at')->count(),
            'overdue_installments' => Installment::query()->whereNull('paid_at')->where('due_date', '<', now())->count(),

            // Para gráfico de vendas por mês
            'sales_per_month' => Sale::query()
//                ->selectRaw("strftime('%Y-%m', sold_at) as period, SUM(total) as total")
                ->selectRaw("DATE_FORMAT(sold_at, '%Y-%m') as period, SUM(total) as total")
                ->groupBy('period')
                ->orderBy('period')
                ->get(),

            // Gráfico tipo de pagamento
            'payment_type_stats' => Sale::query()->selectRaw('payment_type, COUNT(*) as total')
                ->groupBy('payment_type')
                ->get(),
        ]);
    }
}
