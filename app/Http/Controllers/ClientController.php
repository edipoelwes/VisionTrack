<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $perPage = request()->input('per_page', 10);
        $clients = Client::query()
            ->when(request()->input('search'), function ($query, $search) {
                $sanitizedSearch = preg_replace('/\D/', '', $search);
                $lowerSearch = strtolower($search);
                $query->where(function ($q) use ($lowerSearch, $sanitizedSearch) {
                    $q->whereRaw('LOWER(name) LIKE ?', ["%{$lowerSearch}%"])
                        ->orWhereRaw("REPLACE(REPLACE(REPLACE(cpf, '.', ''), '-', ''), ' ', '') LIKE ?", ["%{$sanitizedSearch}%"]);
                });
            })
            ->orderBy('name')
            ->paginate($perPage)
            ->withQueryString();

        return Inertia::render('Client/Index', [
            'clients' => $clients,
            'perPage' => (int) $perPage,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Client/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $client = $request->user()->company->clients()->create([
            'name' => $validated['name'],
            'cpf' => $validated['cpf'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
        ]);

        foreach ($validated['addresses'] as $address) {
            $client->addresses()->create($address);
        }

        if (!empty($validated['prescriptions'])) {
            foreach ($validated['prescriptions'] as $prescriptionData) {
                $path = $prescriptionData['file']->store('prescriptions', 'public');

                $client->prescriptions()->create([
                    'image_path' => $path,
                    'issued_at' => $prescriptionData['issued_at'],
                    'notes' => $prescriptionData['notes'] ?? null,
                ]);
            }
        }

        return redirect()->route('clients.index')->with('success', 'Cliente criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client): Response
    {
        return Inertia::render('Client/Show', [
            'client' => $client->load('addresses'),
            'prescriptions' => $client->prescriptions->map(function ($prescription) {
                return [
                    'id' => $prescription->id,
                    'image_path' => $prescription->image_path,
                    'notes' => $prescription->notes,
                    'issued_at' => $prescription->issued_at?->format('d/m/Y'),
                ];
            }),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client): RedirectResponse
    {
        foreach ($client->prescriptions as $prescription) {
            if ($prescription->image_path && Storage::disk('public')->exists($prescription->image_path)) {
                Storage::disk('public')->delete($prescription->image_path);
            }
        }

        $client->addresses()->delete();
        $client->prescriptions()->delete();

        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Cliente deletado com sucesso.');
    }
}
