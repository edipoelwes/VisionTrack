<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Installment;
use App\Models\Sale;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): \Inertia\Response
    {
        return Inertia::render('Dashboard', [
            'total_clients' => Client::count(),
            'total_sales' => Sale::count(),
            'total_sales_month' => Sale::whereMonth('sold_at', now()->month)->sum('total'),
            'total_revenue' => Sale::sum('total'),
            'pending_installments' => Installment::whereNull('paid_at')->count(),
            'overdue_installments' => Installment::whereNull('paid_at')->where('due_date', '<', now())->count(),

            // Para gráfico de vendas por mês
            'sales_per_month' => Sale::selectRaw("strftime('%Y-%m', sold_at) as period, SUM(total) as total")
                ->groupBy('period')
                ->orderBy('period')
                ->get(),

            // Gráfico tipo de pagamento
            'payment_type_stats' => Sale::selectRaw('payment_type, COUNT(*) as total')
                ->groupBy('payment_type')
                ->get(),
        ]);
    }
}
