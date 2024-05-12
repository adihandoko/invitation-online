<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\PreweddingPhoto;
use App\Models\PrewedPhotoCategory;
use App\Models\RekeningTransfer; // Import RekeningTransfer model
use Illuminate\Http\Request;
use Carbon\Carbon;

class PublicInvitationController extends Controller
{
    public function show($invitationId)
    {
        // Mengambil undangan dengan detail pernikahan dan foto prewedding
        $invitation = Invitation::with(['wedding', 'preweddingPhotos', 'eventCategory'])->findOrFail($invitationId);
        
        // Mengambil semua kategori foto prewedding yang terkait dengan undangan
        $relatedCategories = PrewedPhotoCategory::whereHas('preweddingPhotos', function ($query) use ($invitationId) {
            $query->where('invitation_id', $invitationId);
        })->with('preweddingPhotos');

        // Mengambil semua kategori foto prewedding yang tidak terkait dengan undangan
        $unrelatedCategories = PrewedPhotoCategory::whereDoesntHave('preweddingPhotos')->with('preweddingPhotos');

        // Menggabungkan hasil query
        $prewedPhotoCategories = $relatedCategories->union($unrelatedCategories)->get();
        // Buat array asosiatif dengan nama kategori sebagai kunci
        $photosByCategory = [];
        foreach ($prewedPhotoCategories as $category) {
            $photos = "";
            foreach ($category->preweddingPhotos as $photo) {
                $photos = $photo->photo_path;
            }
            $photosByCategory[$category->name] = $photos;
        }
        // Retrieve bank information for the wedding
        $bankAccounts = RekeningTransfer::with('masterBank')
            ->where('wedding_id', $invitation->wedding->id)
            ->get();
        // dd($bankAccounts[0]->masterBank->nama_bank);

        // Format event date
        $invitation->event_date = Carbon::parse($invitation->event_date)->translatedFormat('l, j F Y');
        $akad_date = Carbon::parse($invitation->wedding->akad_date)->format('l, j F Y');
        $wedding_date = Carbon::parse($invitation->wedding->wedding_date)->format('l, j F Y');
        $event_date = Carbon::parse($invitation->event_date)->format('Ymd\THis');
        
        $unduhMantu = "minggu, 23 Juni 2024";
        $to ="Bapak/Ibu/Saudara/i";
        return view('public.show_invitation', compact(
            'invitation', 
            'photosByCategory',
            'event_date',
            'akad_date',
            'wedding_date',
            'bankAccounts',
            'to',
            'unduhMantu', // Pass bank account information to the view
        ));
    }
    public function showto($invitationId,$to)
    {
        // Mengambil undangan dengan detail pernikahan dan foto prewedding
        $invitation = Invitation::with(['wedding', 'preweddingPhotos', 'eventCategory'])->findOrFail($invitationId);
        
        // Mengambil semua kategori foto prewedding yang terkait dengan undangan
        $relatedCategories = PrewedPhotoCategory::whereHas('preweddingPhotos', function ($query) use ($invitationId) {
            $query->where('invitation_id', $invitationId);
        })->with('preweddingPhotos');

        // Mengambil semua kategori foto prewedding yang tidak terkait dengan undangan
        $unrelatedCategories = PrewedPhotoCategory::whereDoesntHave('preweddingPhotos')->with('preweddingPhotos');

        // Menggabungkan hasil query
        $prewedPhotoCategories = $relatedCategories->union($unrelatedCategories)->get();
        // Buat array asosiatif dengan nama kategori sebagai kunci
        $photosByCategory = [];
        foreach ($prewedPhotoCategories as $category) {
            $photos = "";
            foreach ($category->preweddingPhotos as $photo) {
                $photos = $photo->photo_path;
            }
            $photosByCategory[$category->name] = $photos;
        }
        // Retrieve bank information for the wedding
        $bankAccounts = RekeningTransfer::with('masterBank')
            ->where('wedding_id', $invitation->wedding->id)
            ->get();
        // dd($bankAccounts[0]->masterBank->nama_bank);

        // Format event date

        $event_date = Carbon::parse($invitation->event_date)->format('Ymd\THis');
        \Carbon\Carbon::setLocale('id');
        $invitation->event_date = Carbon::parse($invitation->event_date)->translatedFormat('l, j F Y');
        $akad_date = Carbon::parse($invitation->wedding->akad_date)->translatedFormat('l, j F Y');
        $wedding_date = Carbon::parse($invitation->wedding->wedding_date)->translatedFormat('l, j F Y');
        $unduhMantu = "Minggu, 23 Juni 2024";
        return view('public.show_invitation', compact(
            'invitation', 
            'photosByCategory',
            'event_date',
            'akad_date',
            'wedding_date',
            'bankAccounts',
            'to',
            'unduhMantu', // Pass bank account information to the view
        ));
    }
}
