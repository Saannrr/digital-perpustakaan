<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku as ModelsBuku;

class BukuController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('petugas/buku/index');
    }

    // In your BukuController or any appropriate controller
    public function previewPdf($id)
    {
        $buku = ModelsBuku::findOrFail($id);

        // Check if file exists
        $filePath = storage_path('app/public/' . $buku->file_buku);
        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"'
        ]);
    }
}
