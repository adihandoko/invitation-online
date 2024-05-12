<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekeningTransfer;

class AdminRekeningController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nomor_rekening' => 'required|string',
            'atas_nama' => 'required|string',
            'wedding_id' => 'required|exists:weddings,id',
            'master_bank_id' => 'required|exists:master_banks,id', // Added validation for master_bank_id
        ]);

        RekeningTransfer::create([
            'nomor_rekening' => $request->nomor_rekening,
            'atas_nama' => $request->atas_nama,
            'wedding_id' => $request->wedding_id,
            'master_bank_id' => $request->master_bank_id, // Added master_bank_id
        ]);

        return redirect()->back()->with('success', 'Nomor rekening berhasil ditambahkan');
    }
}
