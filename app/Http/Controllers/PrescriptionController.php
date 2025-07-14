<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class PrescriptionController extends Controller
{
    public function destroy($id): RedirectResponse
    {
        $prescription = Prescription::query()->findOrFail($id);

        if ($prescription->image_path && Storage::exists($prescription->image_path)) {
            Storage::delete($prescription->image_path);
        }

        $prescription->delete();

        return redirect()->back()->banner('Prescription removed successfully.');
    }
}
