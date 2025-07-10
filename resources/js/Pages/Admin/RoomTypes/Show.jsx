import AuthLayout from "@/layouts/AuthLayout";
import { Link } from "@inertiajs/react";

export default function Show({ room_type }) {
  return (
    <AuthLayout>
      <h1 className="text-2xl font-bold text-gray-800 mb-4">Room Type Details</h1>

      <div className="space-y-4">
        <div>
          <label className="font-semibold text-gray-700">Hotel:</label>
          <p className="text-gray-900">{room_type.hotel.name}</p>
        </div>

        <div>
          <label className="font-semibold text-gray-700">Type Name:</label>
          <p className="text-gray-900">{room_type.type_name}</p>
        </div>

        <div>
          <label className="font-semibold text-gray-700">Description:</label>
          <p className="text-gray-900">{room_type.description}</p>
        </div>

        <div>
          <label className="font-semibold text-gray-700">Max Occupancy:</label>
          <p className="text-gray-900">{room_type.max_occupancy}</p>
        </div>

        <div>
          <label className="font-semibold text-gray-700">Price Per Night:</label>
          <p className="text-gray-900">{room_type.price_per_night}</p>
        </div>
      </div>

      <div className="mt-6">
        <Link
          href={route("room-types.index")}
          className="inline-block px-4 py-2 text-sm text-white bg-blue-600 hover:bg-blue-700 rounded"
        >
          ← Back to Room Types
        </Link>
      </div>
    </AuthLayout>
  );
}
