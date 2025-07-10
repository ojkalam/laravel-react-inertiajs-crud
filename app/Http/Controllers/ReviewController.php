<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Review::with(['user', 'hotel'])->latest()->get();
        return Inertia::render('Admin/Reviews/Index', ['reviews' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     */
    public function show(Review $review)
    {
        $review->load(['user', 'hotel']);
        return Inertia::render('Admin/Reviews/Show', ['review' => $review]);
    }


    public function create()
    {
        $users = \App\Models\User::all();
        $hotels = \App\Models\Hotel::all();
        return Inertia::render('Admin/Reviews/Create', ['users' => $users, 'hotels' => $hotels]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'hotel_id' => 'required|exists:hotels,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        try {
            Review::create($validator->validated());
            return Redirect::route('reviews.index')->with('success', 'Review Created Successfully.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'An error occurred while creating the review: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     */
    public function edit(Review $review)
    {
        $users = \App\Models\User::all();
        $hotels = \App\Models\Hotel::all();
        return Inertia::render('Admin/Reviews/Edit', ['review' => $review, 'users' => $users, 'hotels' => $hotels]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Review $review)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'hotel_id' => 'required|exists:hotels,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        try {
            $review->update($validator->validated());
            return Redirect::route('reviews.index')->with('success', 'Review Data Updated.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'An error occurred while updating the review: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Review $review)
    {
        try {
            $review->delete();
            return Redirect::route('reviews.index')->with('success', 'Review Deleted Successfully.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'An error occurred while deleting the review: ' . $e->getMessage());
        }
    }
}
