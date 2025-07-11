<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Amenity;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $hotels = Hotel::where('name', 'like', "%{$query}%")->get();
        $rooms = Room::where('room_number', 'like', "%{$query}%")->get();
        $amenities = Amenity::where('name', 'like', "%{$query}%")->get();

        return Inertia::render('Search/Index', [
            'query' => $query,
            'results' => [
                'hotels' => $hotels,
                'rooms' => $rooms,
                'amenities' => $amenities,
            ],
        ]);
    }
}
