import AuthLayout from "@/layouts/AuthLayout";
import { Link } from "@inertiajs/react";

export default function Show({ review }) {
  return (
    <AuthLayout>
      <h1 className="text-2xl font-bold text-gray-800 mb-4">Review Details</h1>

      <div className="space-y-4">
        <div>
          <label className="font-semibold text-gray-700">User:</label>
          <p className="text-gray-900">{review.user.name}</p>
        </div>

        <div>
          <label className="font-semibold text-gray-700">Hotel:</label>
          <p className="text-gray-900">{review.hotel.name}</p>
        </div>

        <div>
          <label className="font-semibold text-gray-700">Rating:</label>
          <p className="text-gray-900">{review.rating}</p>
        </div>

        <div>
          <label className="font-semibold text-gray-700">Comment:</label>
          <p className="text-gray-900">{review.comment}</p>
        </div>
      </div>

      <div className="mt-6">
        <Link
          href={route("reviews.index")}
          className="inline-block px-4 py-2 text-sm text-white bg-blue-600 hover:bg-blue-700 rounded"
        >
          ← Back to Reviews
        </Link>
      </div>
    </AuthLayout>
  );
}
