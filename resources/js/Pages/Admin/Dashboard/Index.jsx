import AuthLayout from "@/layouts/AuthLayout";
import { Head, Link } from "@inertiajs/react";
import { Bar, Pie } from "react-chartjs-2";
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  BarElement,
  Title,
  Tooltip,
  Legend,
  ArcElement,
} from "chart.js";

ChartJS.register(
  CategoryScale,
  LinearScale,
  BarElement,
  Title,
  Tooltip,
  Legend,
  ArcElement
);

export default function Dashboard({
  hotelCount,
  amenityCount,
  roomTypeCount,
  reviewCount,
  recentHotels,
  recentAmenities,
  recentRoomTypes,
  recentReviews,
  hotelRatings,
  roomTypeDistribution,
}) {
  const barChartData = {
    labels: hotelRatings.map((data) => `Rating ${data.rating}`),
    datasets: [
      {
        label: "Number of Hotels",
        data: hotelRatings.map((data) => data.count),
        backgroundColor: "rgba(75, 192, 192, 0.6)",
        borderColor: "rgba(75, 192, 192, 1)",
        borderWidth: 1,
      },
    ],
  };

  const pieChartData = {
    labels: roomTypeDistribution.map((data) => data.type_name),
    datasets: [
      {
        label: "Room Type Distribution",
        data: roomTypeDistribution.map((data) => data.count),
        backgroundColor: [
          "rgba(255, 99, 132, 0.6)",
          "rgba(54, 162, 235, 0.6)",
          "rgba(255, 206, 86, 0.6)",
          "rgba(75, 192, 192, 0.6)",
          "rgba(153, 102, 255, 0.6)",
          "rgba(255, 159, 64, 0.6)",
        ],
        borderColor: [
          "rgba(255, 99, 132, 1)",
          "rgba(54, 162, 235, 1)",
          "rgba(255, 206, 86, 1)",
          "rgba(75, 192, 192, 1)",
          "rgba(153, 102, 255, 1)",
          "rgba(255, 159, 64, 1)",
        ],
        borderWidth: 1,
      },
    ],
  };

  const barChartOptions = {
    responsive: true,
    plugins: {
      legend: {
        position: "top",
      },
      title: {
        display: true,
        text: "Hotels by Rating",
      },
    },
  };

  const pieChartOptions = {
    responsive: true,
    plugins: {
      legend: {
        position: "top",
      },
      title: {
        display: true,
        text: "Room Type Distribution",
      },
    },
  };

  return (
    <AuthLayout>
      <Head title="Dashboard" />

      <h1 className="text-2xl font-bold text-gray-800 mb-6">Dashboard</h1>

      {/* Stats Cards */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
          <h2 className="text-lg font-semibold text-gray-700">Total Hotels</h2>
          <p className="text-3xl font-bold text-blue-600">{hotelCount}</p>
        </div>
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
          <h2 className="text-lg font-semibold text-gray-700">Total Amenities</h2>
          <p className="text-3xl font-bold text-green-600">{amenityCount}</p>
        </div>
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
          <h2 className="text-lg font-semibold text-gray-700">Total Room Types</h2>
          <p className="text-3xl font-bold text-yellow-600">{roomTypeCount}</p>
        </div>
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
          <h2 className="text-lg font-semibold text-gray-700">Total Reviews</h2>
          <p className="text-3xl font-bold text-red-600">{reviewCount}</p>
        </div>
      </div>

      {/* Charts Section */}
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
          <Bar data={barChartData} options={barChartOptions} />
        </div>
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
          <Pie data={pieChartData} options={pieChartOptions} />
        </div>
      </div>

      {/* Recent Entries Tables */}
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {/* Recent Hotels */}
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
          <h2 className="text-lg font-semibold text-gray-700 mb-4">Recent Hotels</h2>
          <div className="overflow-x-auto">
            <table className="min-w-full divide-y divide-gray-200">
              <thead className="bg-gray-50">
                <tr>
                  <th className="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                  <th className="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">City</th>
                  <th className="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                </tr>
              </thead>
              <tbody className="bg-white divide-y divide-gray-200">
                {recentHotels.map((hotel) => (
                  <tr key={hotel.id}>
                    <td className="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{hotel.name}</td>
                    <td className="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{hotel.city}</td>
                    <td className="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{hotel.rating}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
          <div className="mt-4 text-right">
            <Link href={route("hotels.index")} className="text-blue-600 hover:underline text-sm">
              View All Hotels
            </Link>
          </div>
        </div>

        {/* Recent Amenities */}
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
          <h2 className="text-lg font-semibold text-gray-700 mb-4">Recent Amenities</h2>
          <div className="overflow-x-auto">
            <table className="min-w-full divide-y divide-gray-200">
              <thead className="bg-gray-50">
                <tr>
                  <th className="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                  <th className="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Icon</th>
                </tr>
              </thead>
              <tbody className="bg-white divide-y divide-gray-200">
                {recentAmenities.map((amenity) => (
                  <tr key={amenity.id}>
                    <td className="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{amenity.name}</td>
                    <td className="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{amenity.icon}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
          <div className="mt-4 text-right">
            <Link href={route("amenities.index")} className="text-blue-600 hover:underline text-sm">
              View All Amenities
            </Link>
          </div>
        </div>

        {/* Recent Room Types */}
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
          <h2 className="text-lg font-semibold text-gray-700 mb-4">Recent Room Types</h2>
          <div className="overflow-x-auto">
            <table className="min-w-full divide-y divide-gray-200">
              <thead className="bg-gray-50">
                <tr>
                  <th className="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type Name</th>
                  <th className="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hotel</th>
                  <th className="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Max Occupancy</th>
                </tr>
              </thead>
              <tbody className="bg-white divide-y divide-gray-200">
                {recentRoomTypes.map((roomType) => (
                  <tr key={roomType.id}>
                    <td className="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{roomType.type_name}</td>
                    <td className="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{roomType.hotel.name}</td>
                    <td className="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{roomType.max_occupancy}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
          <div className="mt-4 text-right">
            <Link href={route("room-types.index")} className="text-blue-600 hover:underline text-sm">
              View All Room Types
            </Link>
          </div>
        </div>

        {/* Recent Reviews */}
        <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
          <h2 className="text-lg font-semibold text-gray-700 mb-4">Recent Reviews</h2>
          <div className="overflow-x-auto">
            <table className="min-w-full divide-y divide-gray-200">
              <thead className="bg-gray-50">
                <tr>
                  <th className="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                  <th className="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hotel</th>
                  <th className="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                </tr>
              </thead>
              <tbody className="bg-white divide-y divide-gray-200">
                {recentReviews.map((review) => (
                  <tr key={review.id}>
                    <td className="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{review.user.name}</td>
                    <td className="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{review.hotel.name}</td>
                    <td className="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{review.rating}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
          <div className="mt-4 text-right">
            <Link href={route("reviews.index")} className="text-blue-600 hover:underline text-sm">
              View All Reviews
            </Link>
          </div>
        </div>
      </div>
    </AuthLayout>
  );
}