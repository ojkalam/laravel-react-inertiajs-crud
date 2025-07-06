<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomTypeRequest;
use App\Http\Requests\UpdateRoomTypeRequest;
use App\Models\RoomType;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(): View|RedirectResponse
    {
        try {
            $roomTypes = RoomType::all();
            return view('room_types.index', compact('roomTypes'));
        } catch (\Exception $e) {
            return Redirect::route('dashboard')->with('error', 'An error occurred while retrieving room types: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoomType  $roomType
     * @return \Illuminate\View\View
     */
    public function show(RoomType $roomType): View
    {
        return view('room_types.show', compact('roomType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('room_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoomTypeRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRoomTypeRequest $request): RedirectResponse
    {
        try {
            RoomType::create($request->validated());
            return Redirect::route('room_types.index')->with('success', 'Room type created successfully.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'An error occurred while creating the room type: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoomType  $roomType
     * @return \Illuminate\View\View
     */
    public function edit(RoomType $roomType): View
    {
        return view('room_types.edit', compact('roomType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoomTypeRequest  $request
     * @param  \App\Models\RoomType  $roomType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRoomTypeRequest $request, RoomType $roomType): RedirectResponse
    {
        try {
            $roomType->update($request->validated());
            return Redirect::route('room_types.index')->with('success', 'Room type updated successfully.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'An error occurred while updating the room type: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoomType  $roomType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(RoomType $roomType): RedirectResponse
    {
        try {
            $roomType->delete();
            return Redirect::route('room_types.index')->with('success', 'Room type deleted successfully.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'An error occurred while deleting the room type: ' . $e->getMessage());
        }
    }
}