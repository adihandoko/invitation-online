<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\PreweddingPhoto;
use App\Models\PrewedPhotoCategory; // Tambahkan model PrewedPhotoCategory

class AdminPreweddingController extends Controller
{
    public function create($invitation)
    {
        // Temukan undangan berdasarkan ID
        $invitation = Invitation::findOrFail($invitation);

        // Ambil semua kategori foto prewedding
        $categories = PrewedPhotoCategory::with('preweddingPhotos')->get();

        // Kirim ID undangan dan kategori foto prewedding ke halaman tambah foto prewedding
        return view('admin.prewedding.create', compact('invitation', 'categories'));
    }

    public function store(Request $request, $invitation)
    {
        // Validasi data
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Contoh validasi untuk foto
            'category' => 'required|exists:prewed_photo_categories,id', // Validasi kategori
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);
        // dd($request->category);

        // Simpan foto prewedding ke dalam direktori tertentu, misalnya 'storage/app/public/prewedding'
        $photoPath = $request->file('photo')->store('prewedding_photos', 'public');

        // Buat entri foto prewedding di database dengan kategori yang dipilih
        PreweddingPhoto::create([
            'invitation_id' => $invitation,
            'photo_path' => $photoPath,
            'category_id' => $request->category, // Ambil kategori dari form
            // Tambahkan atribut lainnya sesuai kebutuhan
        ]);

        // Redirect kembali ke halaman detail undangan dengan pesan sukses
        return redirect()->route('admin.invitations.show', $invitation)->with('success', 'Foto prewedding berhasil ditambahkan');
    }
}
