<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Amenity::latest()->get();
        return Inertia::render('Admin/Amenities/Index', ['amenities' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Amenity  $amenity
     */
    public function show(Amenity $amenity)
    {
        return Inertia::render('Admin/Amenities/Show', ['amenity' => $amenity]);
    }


    public function create()
    {
        return Inertia::render('Admin/Amenities/Create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        try {
            Amenity::create($validator->validated());
            return Redirect::route('amenities.index')->with('success', 'Amenity Created Successfully.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'An error occurred while creating the amenity: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Amenity  $amenity
     */
    public function edit(Amenity $amenity)
    {
        return Inertia::render('Admin/Amenities/Edit', ['amenity' => $amenity]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Amenity $amenity)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        try {
            $amenity->update($validator->validated());
            return Redirect::route('amenities.index')->with('success', 'Amenity Data Updated.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'An error occurred while updating the amenity: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Amenity $amenity)
    {
        try {
            $amenity->delete();
            return Redirect::route('amenities.index')->with('success', 'Amenity Deleted Successfully.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'An error occurred while deleting the amenity: ' . $e->getMessage());
        }
    }
}
