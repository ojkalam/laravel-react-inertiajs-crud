import AuthLayout from "@/layouts/AuthLayout";
import { Link, useForm } from "@inertiajs/react";

export default function Edit({ room_type, hotels }) {
  const { data, setData, put, processing, errors } = useForm({
    hotel_id: room_type.hotel_id || "",
    type_name: room_type.type_name || "",
    description: room_type.description || "",
    max_occupancy: room_type.max_occupancy || "",
    price_per_night: room_type.price_per_night || "",
  });

  function handleChange(e) {
    const { name, value } = e.target;
    setData(name, value);
  }

  function handleSubmit(e) {
    e.preventDefault();
    put(route("room-types.update", room_type.id));
  }

  return (
    <AuthLayout>
      <h1 className="text-2xl font-bold text-gray-800 mb-4">Edit Room Type</h1>

      <form onSubmit={handleSubmit} className="space-y-4 max-w-xl">
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
          <label className="block font-semibold text-gray-700">Type Name</label>
          <input
            type="text"
            name="type_name"
            className="w-full mt-1 px-3 py-2 border rounded"
            value={data.type_name}
            onChange={handleChange}
          />
          {errors.type_name && (
            <p className="text-red-600 text-sm mt-1">{errors.type_name}</p>
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
          <label className="block font-semibold text-gray-700">Max Occupancy</label>
          <input
            type="number"
            name="max_occupancy"
            className="w-full mt-1 px-3 py-2 border rounded"
            value={data.max_occupancy}
            onChange={handleChange}
          />
          {errors.max_occupancy && (
            <p className="text-red-600 text-sm mt-1">{errors.max_occupancy}</p>
          )}
        </div>

        <div>
          <label className="block font-semibold text-gray-700">Price Per Night</label>
          <input
            type="text"
            name="price_per_night"
            className="w-full mt-1 px-3 py-2 border rounded"
            value={data.price_per_per_night}
            onChange={handleChange}
          />
          {errors.price_per_night && (
            <p className="text-red-600 text-sm mt-1">{errors.price_per_night}</p>
          )}
        </div>

        <div className="pt-4">
          <button
            type="submit"
            disabled={processing}
            className="px-4 py-2 text-sm text-white bg-green-600 hover:bg-green-700 rounded"
          >
            {processing ? "Updating..." : "Update Room Type"}
          </button>
        </div>
      </form>

      <div className="mt-6">
        <a
          href={route("room-types.index")}
          className="inline-block px-4 py-2 text-sm text-blue-600 hover:underline"
        >
          ← Back to Room Types
        </a>
      </div>
    </AuthLayout>
  );
}
