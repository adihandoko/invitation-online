<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\EventCategory;
use App\Models\PrewedPhotoCategory;
use App\Models\RekeningTransfer; 
use App\Models\MasterBank; 
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminInvitationController extends Controller
{
    public function index()
    {
        $invitations = Invitation::with('eventCategory')->get();
        return view('admin.invitations.index', compact('invitations'));
    }
    
    public function show($invitationId)
    {
        // Fetch a single invitation with its related data
        $invitation = Invitation::with('eventCategory', 'wedding', 'preweddingPhotos')
                                ->findOrFail($invitationId);
        
        // Check if it's a wedding invitation
        if ($invitation->eventCategory && $invitation->eventCategory->name == 'Pernikahan') {
            
            // Fetch prewedding photo categories
            $categories = PrewedPhotoCategory::with('preweddingPhotos')->get();
            
            // Fetch bank account details if available
            $bankAccounts = [];
            if ($invitation->wedding) {
                $bankAccounts = RekeningTransfer::with('masterBank')
                                                ->where('wedding_id', $invitation->wedding->id)
                                                ->get();
            }
            
            // Fetch all available master banks
            $masterBanks = MasterBank::all();
            
            // Return the view for wedding invitation
            return view('admin.invitations.show_wedding', compact('invitation', 'categories', 'bankAccounts', 'masterBanks'));
        } else {
            // Return the view for non-wedding invitation
            return view('admin.invitations.show_non_wedding', compact('invitation'));
        }
    }

    public function create()
    {
        $eventCategories = EventCategory::all();
        return view('admin.invitations.create', compact('eventCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:invitations,email',
            'event_date' => 'required|date',
            'event_location' => 'required|string',
            'event_category_id' => 'required|int',
            'slug' => 'unique:invitations,slug' // Ensure slug is unique
        ]);

        $invitation = new Invitation();
        $invitation->fill($request->all());
        $invitation->slug = Str::slug($request->input('slug') ?: $request->input('name'));

        $invitation->save();

        return redirect()->route('admin.invitations.index')->with('success', 'Invitation created successfully');
    }

    public function edit($id)
    {
        $eventCategories = EventCategory::all();
        $invitation = Invitation::findOrFail($id);
        return view('admin.invitations.edit', compact('invitation', 'eventCategories'));
    }
 
    public function update(Request $request, $id)
    {
        $invitation = Invitation::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:invitations,email,' . $invitation->id,
            'event_date' => 'required|date',
            'event_location' => 'required|string',
            'event_category_id' => 'required|int',
            'slug' => [
                'required',
                'string',
                Rule::unique('invitations')->ignore($id),
            ],
        ]);

        $invitation->fill($request->all());
        $invitation->slug = Str::slug($request->input('slug') ?: $request->input('name'));

        $invitation->save();

        return redirect()->route('admin.invitations.index')->with('success', 'Invitation updated successfully');
    }

    public function destroy($id)
    {
        $invitation = Invitation::findOrFail($id);
        $invitation->delete();

        return redirect()->route('admin.invitations.index')->with('success', 'Invitation deleted successfully');
    }
}
