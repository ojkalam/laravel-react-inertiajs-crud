import AuthLayout from "@/layouts/AuthLayout";
import { Link, useForm } from "@inertiajs/react";

export default function Edit({ hotel }) {
  const { data, setData, put, processing, errors } = useForm({
    name: hotel.name || "",
    description: hotel.description || "",
    address: hotel.address || "",
    country: hotel.country || "",
    rating: hotel.rating || 0,
  });

  function handleChange(e) {
    const { name, value } = e.target;
    setData(name, value);
  }

  function handleSubmit(e) {
    e.preventDefault();
    put(route("hotels.update", hotel.id));
  }

  return (
    <AuthLayout>
      <h1 className="text-2xl font-bold text-gray-800 mb-4">Edit Hotel</h1>

      <form onSubmit={handleSubmit} className="space-y-4 max-w-xl">
        <div>
          <label className="block font-semibold text-gray-700">Name</label>
          <input
            type="text"
            name="name"
            className="w-full mt-1 px-3 py-2 border rounded"
            value={data.name}
            onChange={handleChange}
          />
          {errors.name && (
            <p className="text-red-600 text-sm mt-1">{errors.name}</p>
          )}
        </div>

        <div>
          <label className="block font-semibold text-gray-700">
            Description
          </label>
          <textarea
            name="description"
            className="w-full mt-1 px-3 py-2 border rounded"
            value={data.description}
            onChange={handleChange}
          />
          {errors.description && (
            <p className="text-red-600 text-sm mt-1">{errors.description}</p>
          )}
        </div>

        <div>
          <label className="block font-semibold text-gray-700">Address</label>
          <input
            type="text"
            name="address"
            className="w-full mt-1 px-3 py-2 border rounded"
            value={data.address}
            onChange={handleChange}
          />
          {errors.address && (
            <p className="text-red-600 text-sm mt-1">{errors.address}</p>
          )}
        </div>

        <div>
          <label className="block font-semibold text-gray-700">Country</label>
          <input
            type="text"
            name="country"
            className="w-full mt-1 px-3 py-2 border rounded"
            value={data.country}
            onChange={handleChange}
          />
          {errors.country && (
            <p className="text-red-600 text-sm mt-1">{errors.country}</p>
          )}
        </div>

        <div>
          <label className="block font-semibold text-gray-700">Rating</label>
          <input
            type="text"
            name="rating"
            className="w-full mt-1 px-3 py-2 border rounded"
            value={data.rating}
            onChange={handleChange}
          />
          {errors.rating && (
            <p className="text-red-600 text-sm mt-1">{errors.rating}</p>
          )}
        </div>

        <div className="pt-4">
          <button
            type="submit"
            disabled={processing}
            className="px-4 py-2 text-sm text-white bg-green-600 hover:bg-green-700 rounded"
          >
            {processing ? "Updating..." : "Update Hotel"}
          </button>
        </div>
      </form>

      <div className="mt-6">
        <a
          href={route("hotels.index")}
          className="inline-block px-4 py-2 text-sm text-blue-600 hover:underline"
        >
          ← Back to Hotels
        </a>
      </div>
    </AuthLayout>
  );
}
