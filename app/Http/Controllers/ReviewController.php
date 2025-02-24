<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function add(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string|min:10|max:255',
        ]);

        Review::create([
            'content' => strip_tags($validated['content']),
            'user_name' => strip_tags($validated['name']),
            'is_approved' => false
        ]);

        return response()->json(['status' => 'ok'], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function approve(Review $review): JsonResponse
    {
        $this->authorize('moderate', $review);

        $review->update([
            'is_approved' => true,
            'moderated_at' => now()
        ]);

        return response()->json([
            'message' => 'Отзыв одобрен',
            'id' => $review->id
        ]);
    }

    public function reject(Review $review): JsonResponse
    {
        $this->authorize('moderate', $review);

        $review->delete();

        return response()->json([
            'message' => 'Отзыв отклонен',
            'id' => $review->id
        ]);
    }
}
