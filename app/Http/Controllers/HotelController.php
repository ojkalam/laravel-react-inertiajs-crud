<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Hotel::latest()->get();
        return Inertia::render('Admin/Hotels/Index', ['hotels' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return Redirect::route('hotels.index')->with('error', 'Hotel not found.');
        }

        return Inertia::render('Admin/Hotels/Show', ['hotel' => $hotel]);
    }


    public function create()
    {
        return Inertia::render('Admin/Hotels/Create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'zipcode' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        try {
            Hotel::create($validator->validated());
            return Redirect::route('hotels.index')->with('success', 'Hotel Created Successfully.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'An error occurred while creating the hotel: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return Redirect::route('hotels.index')->with('error', 'Hotel not found.');
        }

        return Inertia::render('Admin/Hotels/Edit', props: ['hotel' => $hotel]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'zipcode' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $hotel = Hotel::find($id);

        if (!$hotel) {
            return Redirect::route('hotels.index')->with('error', 'Hotel not found.');
        }

        try {
            $hotel->update($validator->validated());
            return Redirect::route('hotels.index')->with('success', 'Hotel Data Updated.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'An error occurred while updating the hotel: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return Redirect::route('hotels.index')->with('error', 'Hotel not found.');
        }

        try {
            $hotel->delete();
            return Redirect::route('hotels.index')->with('success', 'Hotel Deleted Successfully.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'An error occurred while deleting the hotel: ' . $e->getMessage());
        }
    }
}
