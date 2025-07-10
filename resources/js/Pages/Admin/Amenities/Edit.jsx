import AuthLayout from "@/layouts/AuthLayout";
import { Link, useForm } from "@inertiajs/react";

export default function Edit({ amenity }) {
  const { data, setData, put, processing, errors } = useForm({
    name: amenity.name || "",
    icon: amenity.icon || "",
  });

  function handleChange(e) {
    const { name, value } = e.target;
    setData(name, value);
  }

  function handleSubmit(e) {
    e.preventDefault();
    put(route("amenities.update", amenity.id));
  }

  return (
    <AuthLayout>
      <h1 className="text-2xl font-bold text-gray-800 mb-4">Edit Amenity</h1>

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
            Icon
          </label>
          <input
            type="text"
            name="icon"
            className="w-full mt-1 px-3 py-2 border rounded"
            value={data.icon}
            onChange={handleChange}
          />
          {errors.icon && (
            <p className="text-red-600 text-sm mt-1">{errors.icon}</p>
          )}
        </div>

        <div className="pt-4">
          <button
            type="submit"
            disabled={processing}
            className="px-4 py-2 text-sm text-white bg-green-600 hover:bg-green-700 rounded"
          >
            {processing ? "Updating..." : "Update Amenity"}
          </button>
        </div>
      </form>

      <div className="mt-6">
        <a
          href={route("amenities.index")}
          className="inline-block px-4 py-2 text-sm text-blue-600 hover:underline"
        >
          ← Back to Amenities
        </a>
      </div>
    </AuthLayout>
  );
}
