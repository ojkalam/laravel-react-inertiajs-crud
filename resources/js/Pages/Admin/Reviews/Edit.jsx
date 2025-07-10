import AuthLayout from "@/layouts/AuthLayout";
import { Link, useForm } from "@inertiajs/react";

export default function Edit({ review, users, hotels }) {
  const { data, setData, put, processing, errors } = useForm({
    user_id: review.user_id || "",
    hotel_id: review.hotel_id || "",
    rating: review.rating || "",
    comment: review.comment || "",
  });

  function handleChange(e) {
    const { name, value } = e.target;
    setData(name, value);
  }

  function handleSubmit(e) {
    e.preventDefault();
    put(route("reviews.update", review.id));
  }

  return (
    <AuthLayout>
      <h1 className="text-2xl font-bold text-gray-800 mb-4">Edit Review</h1>

      <form onSubmit={handleSubmit} className="space-y-4 max-w-xl">
        <div>
          <label className="block font-semibold text-gray-700">User</label>
          <select
            name="user_id"
            className="w-full mt-1 px-3 py-2 border rounded"
            value={data.user_id}
            onChange={handleChange}
          >
            <option value="">Select User</option>
            {users && users.map((user) => (
              <option key={user.id} value={user.id}>
                {user.name}
              </option>
            ))}
          </select>
          {errors.user_id && (
            <p className="text-red-600 text-sm mt-1">{errors.user_id}</p>
          )}
        </div>

        <div>
          <label className="block font-semibold text-gray-700">Hotel</label>
          <select
            name="hotel_id"
            className="w-full mt-1 px-3 py-2 border rounded"
            value={data.hotel_id}
            onChange={handleChange}
          >
            <option value="">Select Hotel</option>
            {hotels && hotels.map((hotel) => (
              <option key={hotel.id} value={hotel.id}>
                {hotel.name}
              </option>
            ))}
          </select>
          {errors.hotel_id && (
            <p className="text-red-600 text-sm mt-1">{errors.hotel_id}</p>
          )}
        </div>

        <div>
          <label className="block font-semibold text-gray-700">Rating</label>
          <input
            type="number"
            name="rating"
            className="w-full mt-1 px-3 py-2 border rounded"
            value={data.rating}
            onChange={handleChange}
          />
          {errors.rating && (
            <p className="text-red-600 text-sm mt-1">{errors.rating}</p>
          )}
        </div>

        <div>
          <label className="block font-semibold text-gray-700">
            Comment
          </label>
          <textarea
            name="comment"
            className="w-full mt-1 px-3 py-2 border rounded"
            value={data.comment}
            onChange={handleChange}
          />
          {errors.comment && (
            <p className="text-red-600 text-sm mt-1">{errors.comment}</p>
          )}
        </div>

        <div className="pt-4">
          <button
            type="submit"
            disabled={processing}
            className="px-4 py-2 text-sm text-white bg-green-600 hover:bg-green-700 rounded"
          >
            {processing ? "Updating..." : "Update Review"}
          </button>
        </div>
      </form>

      <div className="mt-6">
        <a
          href={route("reviews.index")}
          className="inline-block px-4 py-2 text-sm text-blue-600 hover:underline"
        >
          ← Back to Reviews
        </a>
      </div>
    </AuthLayout>
  );
}
