<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = RoomType::with('hotel')->latest()->get();
        return Inertia::render('Admin/RoomTypes/Index', ['room_types' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoomType  $roomType
     */
    public function show(RoomType $roomType)
    {
        $roomType->load('hotel');
        return Inertia::render('Admin/RoomTypes/Show', ['room_type' => $roomType]);
    }


    public function create()
    {
        $hotels = \App\Models\Hotel::all();
        return Inertia::render('Admin/RoomTypes/Create', ['hotels' => $hotels]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hotel_id' => 'required|exists:hotels,id',
            'type_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_occupancy' => 'required|integer|min:1',
            'price_per_night' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        try {
            RoomType::create($validator->validated());
            return Redirect::route('room-types.index')->with('success', 'Room Type Created Successfully.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'An error occurred while creating the room type: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoomType  $roomType
     */
    public function edit(RoomType $roomType)
    {
        $hotels = \App\Models\Hotel::all();
        return Inertia::render('Admin/RoomTypes/Edit', ['room_type' => $roomType, 'hotels' => $hotels]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoomType  $roomType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, RoomType $roomType)
    {
        $validator = Validator::make($request->all(), [
            'hotel_id' => 'required|exists:hotels,id',
            'type_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_occupancy' => 'required|integer|min:1',
            'price_per_night' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        try {
            $roomType->update($validator->validated());
            return Redirect::route('room-types.index')->with('success', 'Room Type Data Updated.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'An error occurred while updating the room type: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(RoomType $roomType)
    {
        try {
            $roomType->delete();
            return Redirect::route('room-types.index')->with('success', 'Room Type Deleted Successfully.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'An error occurred while deleting the room type: ' . $e->getMessage());
        }
    }
}
