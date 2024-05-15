<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentWedding;
use App\Models\Wedding;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CommentWeddingController extends Controller
{
    // Create a new comment for a wedding
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'comment' => 'nullable|string',
            'wedding_id' => 'required|exists:weddings,id',
        ]);

        $comment = CommentWedding::create($request->only('name', 'comment', 'wedding_id'));

        return response()->json($comment, 201);
    }

    // Get list of comments by wedding ID in descending order by create date
    public function getByWeddingId($weddingId)
    {
        $comments = CommentWedding::where('wedding_id', $weddingId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function($comment) {
                return [
                    'id' => $comment->id,
                    'name' => $comment->name,
                    'comment' => $comment->comment,
                    'created_at' => Carbon::parse($comment->created_at)->format('d F Y'),
                    'updated_at' => Carbon::parse($comment->updated_at)->format('d-F-Y')
                ];
            });

        if ($comments->isEmpty()) {
            return response()->json([
                'code' => 404,
                'message' => 'No comments found for this wedding ID'
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'data' => $comments
        ]);
    }
}
