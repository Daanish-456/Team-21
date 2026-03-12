<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        $userId = session('UserID');

        if (! $userId) {
            return redirect()->route('login')->with('error', 'You must be logged in to submit a review.');
        }

        Product::where('ProductID', $productId)->firstOrFail();

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);

        $existingReview = Review::where('UserID', $userId)
            ->where('ProductID', $productId)
            ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'You have already reviewed this product. Edit your existing review instead.');
        }

        Review::create([
            'UserID' => $userId,
            'ProductID' => $productId,
            'Rating' => $validated['rating'],
            'Comment' => trim($validated['comment']),
            'ReviewDate' => now(),
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully.');
    }

    public function update(Request $request, $reviewId)
    {
        $userId = session('UserID');

        if (! $userId) {
            return redirect()->route('login')->with('error', 'You must be logged in to edit a review.');
        }

        $review = Review::where('ReviewID', $reviewId)->firstOrFail();

        if ($review->UserID !== $userId) {
            return redirect()->back()->with('error', 'You can only edit your own review.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);

        $review->update([
            'Rating' => $validated['rating'],
            'Comment' => trim($validated['comment']),
            'ReviewDate' => now(),
        ]);

        return redirect()->back()->with('success', 'Review updated successfully.');
    }

    public function destroy($reviewId)
    {
        $userId = session('UserID');

        if (! $userId) {
            return redirect()->route('login')->with('error', 'You must be logged in to delete a review.');
        }

        $review = Review::where('ReviewID', $reviewId)->firstOrFail();

        if ($review->UserID !== $userId) {
            return redirect()->back()->with('error', 'You can only delete your own review.');
        }

        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully.');
    }
}
