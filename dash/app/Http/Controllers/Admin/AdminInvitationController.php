<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\EventCategory;
use App\Models\PrewedPhotoCategory; // Tambahkan model PrewedPhotoCategory

class AdminInvitationController extends Controller
{
    public function index()
    {
        $invitations = Invitation::with('eventCategory')->get();
        return view('admin.invitations.index', compact('invitations'));
    }
    
    public function show($invitation)
    {

        $invitation = Invitation::with([
            'eventCategory', 
            'wedding',
            'preweddingPhotos'
            ])->findOrFail($invitation);
        if ($invitation->eventCategory && $invitation->eventCategory->name == 'Pernikahan') {

            // Ambil semua kategori foto prewedding
            $categories = PrewedPhotoCategory::with('preweddingPhotos')->get();
            return view('admin.invitations.show_wedding', compact('invitation','categories'));
        } else {
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
        ]);

        Invitation::create($request->all());

        return redirect()->route('admin.invitations.index')->with('success', 'Invitation created successfully');
    }

    public function edit($id)
    {
        $eventCategories = EventCategory::all();

        $invitation = Invitation::findOrFail($id);
        return view('admin.invitations.edit', compact('invitation','eventCategories'));
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
        ]);

        $invitation->update($request->all());

        return redirect()->route('admin.invitations.index')->with('success', 'Invitation updated successfully');
    }

    public function destroy($id)
    {
        $invitation = Invitation::findOrFail($id);
        $invitation->update(['deleted_at' => \Carbon\Carbon::now()]);

        return redirect()->route('admin.invitations.index')->with('success', 'Invitation deleted successfully');
    }
}
