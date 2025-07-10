import AuthLayout from "@/layouts/AuthLayout";
import { Link } from "@inertiajs/react";

export default function Show({ amenity }) {
  return (
    <AuthLayout>
      <h1 className="text-2xl font-bold text-gray-800 mb-4">Amenity Details</h1>

      <div className="space-y-4">
        <div>
          <label className="font-semibold text-gray-700">Name:</label>
          <p className="text-gray-900">{amenity.name}</p>
        </div>

        <div>
          <label className="font-semibold text-gray-700">Icon:</label>
          <p className="text-gray-900">{amenity.icon}</p>
        </div>
      </div>

      <div className="mt-6">
        <Link
          href={route("amenities.index")}
          className="inline-block px-4 py-2 text-sm text-white bg-blue-600 hover:bg-blue-700 rounded"
        >
          ← Back to Amenities
        </Link>
      </div>
    </AuthLayout>
  );
}
