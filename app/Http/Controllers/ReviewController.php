<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(): View|RedirectResponse
    {
        try {
            $reviews = Review::all();
            return view('reviews.index', compact('reviews'));
        } catch (\Exception $e) {
            return Redirect::route('dashboard')->with('error', 'An error occurred while retrieving reviews: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\View\View
     */
    public function show(Review $review): View
    {
        return view('reviews.show', compact('review'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReviewRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreReviewRequest $request): RedirectResponse
    {
        try {
            Review::create($request->validated());
            return Redirect::route('reviews.index')->with('success', 'Review created successfully.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'An error occurred while creating the review: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\View\View
     */
    public function edit(Review $review): View
    {
        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateReviewRequest $request, Review $review): RedirectResponse
    {
        try {
            $review->update($request->validated());
            return Redirect::route('reviews.index')->with('success', 'Review updated successfully.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'An error occurred while updating the review: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Review $review): RedirectResponse
    {
        try {
            $review->delete();
            return Redirect::route('reviews.index')->with('success', 'Review deleted successfully.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'An error occurred while deleting the review: ' . $e->getMessage());
        }
    }
}