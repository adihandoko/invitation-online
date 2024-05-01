<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wedding;

class AdminWeddingController extends Controller
{
    public function create()
    {
        return view('admin.weddings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'invitation_id' => 'required',
            'bride_name' => 'required',
            'groom_name' => 'required',
            'wedding_venue' => 'required',
            'number_of_guests' => 'required|integer',
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);
    
        Wedding::create($request->all());
    
        // Redirect kembali ke halaman detail undangan dengan pesan sukses
        return redirect()->route('admin.invitations.show', $request->invitation_id)->with('success', 'Detail pernikahan berhasil ditambahkan');
    }
}
