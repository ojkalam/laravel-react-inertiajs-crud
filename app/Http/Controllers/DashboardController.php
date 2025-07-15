<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Hotel;
use App\Models\Review;
use App\Models\RoomType;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $hotelCount = Hotel::count();
        $amenityCount = Amenity::count();
        $roomTypeCount = RoomType::count();
        $reviewCount = Review::count();

        $recentHotels = Hotel::latest()->take(5)->get();
        $recentAmenities = Amenity::latest()->take(5)->get();
        $recentRoomTypes = RoomType::with('hotel')->latest()->take(5)->get();
        $recentReviews = Review::with(['user', 'hotel'])
            ->latest()
            ->take(5)
            ->get();

        // Data for Bar Chart (Hotels by Rating)
        $hotelRatings = Hotel::selectRaw('rating, count(*) as count')->groupBy('rating')->orderBy('rating')->get();

        // Data for Pie Chart (Room Types Distribution)
        $roomTypeDistribution = RoomType::selectRaw('type_name, count(*) as count')->groupBy('type_name')->get();

        return Inertia::render('Admin/Dashboard/Index', [
            'hotelCount' => $hotelCount,
            'amenityCount' => $amenityCount,
            'roomTypeCount' => $roomTypeCount,
            'reviewCount' => $reviewCount,
            'recentHotels' => $recentHotels,
            'recentAmenities' => $recentAmenities,
            'recentRoomTypes' => $recentRoomTypes,
            'recentReviews' => $recentReviews,
            'hotelRatings' => $hotelRatings,
            'roomTypeDistribution' => $roomTypeDistribution,
        ]);
    }

    public function instanceName()
    {
        try{
        $instanceName = file_get_contents(
            'http://metadata.google.internal/computeMetadata/v1/instance/name',
            false,
            stream_context_create([
                'http' => [
                    'method' => 'GET',
                    'header' => 'Metadata-Flavor: Google',
                ],
            ]),
        );
        $instanceName = 'Instance name: '.$instanceName;
            return response()->json(['instance' => $instanceName], 200);
        }catch(\Exception $e){
            return response()->json(['message' => 'Failed to get instance name.'], 500);
        }

    }
}
