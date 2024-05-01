<?php

// app/Http/Controllers/PublicInvitationController.php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;

class PublicInvitationController extends Controller
{
    public function show($invitationId)
    {
        $invitation = Invitation::with(['wedding', 'preweddingPhotos'])->findOrFail($invitationId);

        return view('public.show_invitation', compact('invitation'));
    }
}

