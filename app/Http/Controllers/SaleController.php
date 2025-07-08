<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Inertia\Inertia;
use Inertia\Response;

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
            'perPage' => (int) $perPage,
        ]);
    }
}
