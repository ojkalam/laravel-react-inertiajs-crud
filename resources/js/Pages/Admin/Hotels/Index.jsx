import AuthLayout from "@/layouts/AuthLayout";
import { Link, router } from "@inertiajs/react";
export default function Index({ hotels, success }) {
  function handleDelete(hotel_id) {
    if (confirm("Are you sure to delete?")) {
      router.delete(route("hotels.destroy", hotel_id));
    }
  }
  return (
    <AuthLayout>
      <div className="mb-6">
        <h1 className="text-2xl font-bold text-gray-800">Hotels</h1>
        <p className="text-gray-600">Lists</p>
        <Link
          href={route("hotels.create")}
          className="px-3 py-1 text-sm text-green-600 border border-green-600 rounded hover:bg-red-50 transition"
        >
          Create New Hotel
        </Link>
      </div>
      {success && (
        <div className="mb-4 p-3 bg-green-100 text-green-800 rounded">
          {success}
        </div>
      )}

      {/* <!-- Content Section - Left blank for customization --> */}
      <div className="bg-white rounded-lg shadow-sm border border-gray-200 p-6 min-h-96">
        {/* <!-- Your content goes here --> */}
        <div className="overflow-x-auto">
          <table className="min-w-full divide-y divide-gray-200 border rounded-lg">
            <thead className="bg-gray-100">
              <tr>
                <th className="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                  Name
                </th>
                <th className="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                  description
                </th>
                <th className="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                  address
                </th>
                <th className="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                  country
                </th>
                <th className="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                  rating
                </th>
                <th className="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                  Action
                </th>
              </tr>
            </thead>
            <tbody className="bg-white divide-y divide-gray-200">
              {hotels.map((hotel) => (
                <tr key={hotel.id}>
                  <td className="px-4 py-2 text-sm text-gray-800">
                    {hotel.name}
                  </td>
                  <td className="px-4 py-2 text-sm text-gray-800">
                    {hotel.description}
                  </td>
                  <td className="px-4 py-2 text-sm text-gray-800">
                    {hotel.address}
                  </td>
                  <td className="px-4 py-2 text-sm text-gray-800">
                    {hotel.country}
                  </td>
                  <td className="px-4 py-2 text-sm text-gray-800">
                    {hotel.rating}
                  </td>
                  <td className="px-4 py-2 flex gap-2">
                    <Link
                      href={route("hotels.show", hotel.id)}
                      className="px-3 py-1 text-sm text-blue-600 border border-blue-600 rounded hover:bg-blue-50 transition"
                    >
                      View
                    </Link>
                    <Link
                      href={route("hotels.edit", hotel.id)}
                      className="px-3 py-1 text-sm text-yellow-600 border border-yellow-600 rounded hover:bg-yellow-50 transition"
                    >
                      Edit
                    </Link>
                    <button
                      onClick={() => handleDelete(hotel.id)}
                      className="px-3 py-1 text-sm text-red-600 border border-red-600 rounded hover:bg-red-50 transition"
                    >
                      Delete
                    </button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </AuthLayout>
  );
}
