<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAmenityRequest;
use App\Http\Requests\UpdateAmenityRequest;
use App\Models\Amenity;
use Illuminate\Support\Facades\Redirect;

class AmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            $amenities = Amenity::all();
            return view('amenities.index', compact('amenities'));
        } catch (\Exception $e) {
            return Redirect::route('dashboard')->with('error', 'An error occurred while retrieving amenities: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\View\View
     */
    public function show(Amenity $amenity)
    {
        return view('amenities.show', compact('amenity'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAmenityRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('amenities.create');
    }

    public function store(StoreAmenityRequest $request)
    {
        try {
            Amenity::create($request->validated());
            return Redirect::route('amenities.index')->with('success', 'Amenity created successfully.');
        } catch (\Exception $e) {
            return Redirect::back()
                ->with('error', 'An error occurred while creating the amenity: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\View\View
     */
    public function edit(Amenity $amenity)
    {
        return view('amenities.edit', compact('amenity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAmenityRequest  $request
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAmenityRequest $request, Amenity $amenity)
    {
        try {
            $amenity->update($request->validated());
            return Redirect::route('amenities.index')->with('success', 'Amenity updated successfully.');
        } catch (\Exception $e) {
            return Redirect::back()
                ->with('error', 'An error occurred while updating the amenity: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Amenity $amenity)
    {
        try {
            $amenity->delete();
            return Redirect::route('amenities.index')->with('success', 'Amenity deleted successfully.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'An error occurred while deleting the amenity: ' . $e->getMessage());
        }
    }
}
