import React from 'react';
import AuthLayout from '@/layouts/AuthLayout';

export default function Index({ query, results }) {
    return (
        <AuthLayout>
            <div className="container mx-auto px-4 py-8">
                <h1 className="text-2xl font-bold mb-4">Search Results for "{query}"</h1>

                <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h2 className="text-xl font-semibold mb-4">Hotels</h2>
                        {results.hotels.length > 0 ? (
                            <ul className="space-y-2">
                                {results.hotels.map(hotel => (
                                    <li key={hotel.id} className="p-4 bg-white rounded-lg shadow">
                                        <a href={`/hotels/${hotel.id}`} className="text-blue-600 hover:underline">{hotel.name}</a>
                                    </li>
                                ))}
                            </ul>
                        ) : (
                            <p>No hotels found.</p>
                        )}
                    </div>

                    <div>
                        <h2 className="text-xl font-semibold mb-4">Rooms</h2>
                        {results.rooms.length > 0 ? (
                            <ul className="space-y-2">
                                {results.rooms.map(room => (
                                    <li key={room.id} className="p-4 bg-white rounded-lg shadow">
                                        <p>Room No: {room.room_number}</p>
                                    </li>
                                ))}
                            </ul>
                        ) : (
                            <p>No rooms found.</p>
                        )}
                    </div>

                    <div>
                        <h2 className="text-xl font-semibold mb-4">Amenities</h2>
                        {results.amenities.length > 0 ? (
                            <ul className="space-y-2">
                                {results.amenities.map(amenity => (
                                    <li key={amenity.id} className="p-4 bg-white rounded-lg shadow">
                                        <p>{amenity.name}</p>
                                    </li>
                                ))}
                            </ul>
                        ) : (
                            <p>No amenities found.</p>
                        )}
                    </div>
                </div>
            </div>
        </AuthLayout>
    );
}
