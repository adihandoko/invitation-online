<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;

class PublicInvitationController extends Controller
{
    public function show($invitationId)
    {
        // Mengambil undangan dengan detail pernikahan dan foto prewedding
        $invitation = Invitation::with(['wedding', 'preweddingPhotos', 'eventCategory'])->findOrFail($invitationId);
        // dd( $invitation->preweddingPhotos);
        return view('public.show_invitation', compact('invitation'));
    }
}
