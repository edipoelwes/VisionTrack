<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Models\Client;
use App\Models\Installment;
use App\Models\Sale;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $perPage = request()->input('per_page', 10);
        $sales = Sale::query()
            ->with(['client', 'installments'])
            ->orderBy('id', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        return Inertia::render('Sale/Index', [
            'sales' => $sales,
            'clients' => Client::all(),
            'perPage' => (int) $perPage,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $sale = Sale::query()->create([
                'client_id' => $validated['client_id'],
                'total' => $validated['total'],
                'sold_at' => $validated['sold_at'],
                'payment_type' => $validated['payment_type'],
                'installments_count' => $validated['installments_count'] ?? null,
            ]);

            // Se for parcelado, cria as parcelas
            if ($validated['payment_type'] === 'installment') {
                $installments = [];

                $count = $validated['installments_count'];
                $amount = round($validated['total'] / $count, 2);

                $dueDate = Carbon::parse($validated['sold_at']);

                for ($i = 1; $i <= $count; $i++) {
                    $installments[] = [
                        'sale_id' => $sale->id,
                        'number' => $i,
                        'amount' => $amount,
                        'due_date' => $dueDate->copy()->addMonths($i - 1),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                Installment::query()->insert($installments);
            }

            DB::commit();

            return redirect()
                ->route('sales.index')
                ->with('success', 'Venda registrada com sucesso.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erro ao registrar a venda: ' . $e->getMessage());
        }
    }
}
