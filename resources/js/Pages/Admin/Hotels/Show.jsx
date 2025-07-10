import AuthLayout from "@/layouts/AuthLayout";
import { Link } from "@inertiajs/react";

export default function Show({ hotel }) {
  return (
    <AuthLayout>
      <h1 className="text-2xl font-bold text-gray-800 mb-4">Hotel Details</h1>

      <div className="space-y-4">
        <div>
          <label className="font-semibold text-gray-700">Name:</label>
          <p className="text-gray-900">{hotel.name}</p>
        </div>

        <div>
          <label className="font-semibold text-gray-700">Description:</label>
          <p className="text-gray-900">{hotel.description}</p>
        </div>

        <div>
          <label className="font-semibold text-gray-700">Address:</label>
          <p className="text-gray-900">{hotel.address}</p>
        </div>

        <div>
          <label className="font-semibold text-gray-700">Country:</label>
          <p className="text-gray-900">{hotel.country}</p>
        </div>

        <div>
          <label className="font-semibold text-gray-700">Rating:</label>
          <p className="text-gray-900">{hotel.rating}</p>
        </div>
      </div>

      <div className="mt-6">
        <Link
          href={route("hotels.index")}
          className="inline-block px-4 py-2 text-sm text-white bg-blue-600 hover:bg-blue-700 rounded"
        >
          ← Back to Hotels
        </Link>
      </div>
    </AuthLayout>
  );
}
