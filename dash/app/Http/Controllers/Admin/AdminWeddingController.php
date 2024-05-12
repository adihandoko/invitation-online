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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'invitation_id' => 'required',
            'bride_name' => 'required|string|max:255',
            'groom_name' => 'required|string|max:255',
            'wedding_venue' => 'required|string|max:255',
            'wedding_date' => 'required|date',
            'akad_date' => 'nullable|date',
            'number_of_guests' => 'required|integer',
            'ibu_mempelai_pria' => 'nullable|string|max:255',
            'ibu_mempelai_wanita' => 'nullable|string|max:255',
            'bapak_mempelai_pria' => 'nullable|string|max:255',
            'bapak_mempelai_wanita' => 'nullable|string|max:255',
        ]);

        // Buat atau update data pernikahan
        $wedding = Wedding::updateOrCreate(
            ['invitation_id' => $request->invitation_id],
            [
                'bride_name' => $request->bride_name,
                'groom_name' => $request->groom_name,
                'wedding_venue' => $request->wedding_venue,
                'wedding_date' => $request->wedding_date,
                'akad_date' => $request->akad_date,
                'number_of_guests' => $request->number_of_guests,
                'ibu_mempelai_pria' => $request->ibu_mempelai_pria,
                'ibu_mempelai_wanita' => $request->ibu_mempelai_wanita,
                'bapak_mempelai_pria' => $request->bapak_mempelai_pria,
                'bapak_mempelai_wanita' => $request->bapak_mempelai_wanita,
            ]
        );

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Detail pernikahan berhasil disimpan.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wedding  $wedding
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wedding $wedding)
    {
        // Validasi input
        $request->validate([
            'bride_name' => 'required|string|max:255',
            'groom_name' => 'required|string|max:255',
            'wedding_venue' => 'required|string|max:255',
            'wedding_date' => 'required|date',
            'akad_date' => 'nullable|date',
            'number_of_guests' => 'required|integer',
            'ibu_mempelai_pria' => 'nullable|string|max:255',
            'ibu_mempelai_wanita' => 'nullable|string|max:255',
            'bapak_mempelai_pria' => 'nullable|string|max:255',
            'bapak_mempelai_wanita' => 'nullable|string|max:255',
        ]);

        // Update data pernikahan
        $wedding->update([
            'bride_name' => $request->bride_name,
            'groom_name' => $request->groom_name,
            'wedding_venue' => $request->wedding_venue,
            'wedding_date' => $request->wedding_date,
            'akad_date' => $request->akad_date,
            'number_of_guests' => $request->number_of_guests,
            'ibu_mempelai_pria' => $request->ibu_mempelai_pria,
            'ibu_mempelai_wanita' => $request->ibu_mempelai_wanita,
            'bapak_mempelai_pria' => $request->bapak_mempelai_pria,
            'bapak_mempelai_wanita' => $request->bapak_mempelai_wanita,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Detail pernikahan berhasil diperbarui.');
    }
}
