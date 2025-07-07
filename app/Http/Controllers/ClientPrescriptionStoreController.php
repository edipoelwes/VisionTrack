<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClientPrescriptionStoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Client $client)
    {
        $validated = $request->validate([
            'prescription.file' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'prescription.issued_at' => 'nullable|date',
            'prescription.notes' => 'nullable|string|max:1000',
        ]);

        $file = $request->file('prescription.file');
        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('prescriptions', $fileName, 'public');

        $client->prescriptions()->create([
            'image_path' => $filePath,
            'issued_at' => $validated['prescription']['issued_at'] ?? null,
            'notes' => $validated['prescription']['notes'] ?? null,
        ]);

        return back()->with('success', 'Receita adicionada com sucesso.');
    }
}
