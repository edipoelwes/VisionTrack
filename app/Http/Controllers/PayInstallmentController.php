<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PayInstallmentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Installment $installment): RedirectResponse
    {
        $validated = $request->validate([
            'paid_at' => ['required', 'date'],
        ]);

        $installment->update(['paid_at' => $validated['paid_at']]);

        return back()->banner('Parcela marcada como paga.');
    }
}
