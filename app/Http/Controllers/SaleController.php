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
            ->when(request()->input('search'), function ($query, $search) {
                $query->whereHas('client', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('cpf', 'like', "%{$search}%");
                });
            })
            ->when(request()->input('date'), function ($query, $date) {
                $query->whereDate('sold_at', $date);
            })
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
                'entry_value' => $validated['entry_value'] ?? 0,
                'first_due_date' => $validated['first_due_date'] ?? null,
            ]);

            if ($validated['payment_type'] === 'installment') {
                $entryValue = $validated['entry_value'] ?? 0;
                $installmentsCount = $validated['installments_count'];
                $parcelValue = round(($validated['total'] - $entryValue) / $installmentsCount, 2);
                $firstDueDate = Carbon::parse($validated['first_due_date']);

                $installments = [];

                for ($i = 1; $i <= $installmentsCount; $i++) {
                    $installments[] = [
                        'sale_id' => $sale->id,
                        'number' => $i,
                        'amount' => $parcelValue,
                        'due_date' => $firstDueDate->copy()->addMonths($i - 1),
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
            return back()->banner('Erro ao registrar a venda: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale): Response
    {
        return Inertia::render('Sale/Show', [
            'sale' => $sale->load(['client', 'installments']),
        ]);
    }

    public function destroy(Sale $sale): RedirectResponse
    {
        $sale->delete();

        return redirect()->back()->banner('Lançamento deletado com sucesso.');
    }
}
