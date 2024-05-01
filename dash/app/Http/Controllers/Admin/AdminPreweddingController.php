<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\PreweddingPhoto;

class AdminPreweddingController extends Controller
{
    public function create($invitation)
    {
        // Temukan undangan berdasarkan ID
        $invitation = Invitation::findOrFail($invitation);

        // Kirim ID undangan ke halaman tambah foto prewedding
        return view('admin.prewedding.create', compact('invitation'));
    }

    public function store(Request $request, $invitation)
    {
        // Validasi data
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Contoh validasi untuk foto
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        // Simpan foto prewedding ke dalam direktori tertentu, misalnya 'storage/app/public/prewedding'
        $photoPath = $request->file('photo')->store('prewedding_photos', 'public');

        // Buat entri foto prewedding di database
        PreweddingPhoto::create([
            'invitation_id' => $invitation,
            'photo_path' => $photoPath,
            // Tambahkan atribut lainnya sesuai kebutuhan
        ]);

        // Redirect kembali ke halaman detail undangan dengan pesan sukses
        return redirect()->route('admin.invitations.show', $invitation)->with('success', 'Foto prewedding berhasil ditambahkan');
    }
}
