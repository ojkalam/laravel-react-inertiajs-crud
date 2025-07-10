import { Link } from "@inertiajs/react";

export default function Sidebar() {
  return (
    <div
      id="sidebar"
      className={`fixed left-0 top-0 h-full w-64 bg-gray-800 text-white transform translate-x-0 transition-transform duration-300 ease-in-out lg:translate-x-0 z-30`}
    >
      <div className="p-4 border-b border-gray-700">
        <h2 className="text-xl font-bold">Hotel Reservation</h2>
      </div>

      <nav className="mt-6">
        <ul className="space-y-2 px-4">
          <li>
            <Link
              href={route("dashboard.index")}
              className="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors"
            >
              <svg
                className="w-5 h-5 mr-3"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth="2"
                  d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"
                ></path>
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth="2"
                  d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"
                ></path>
              </svg>
              Dashboard
            </Link>
          </li>
          <li>
            <Link
              href={route("hotels.index")}
              className="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors"
            >
              <svg
                className="w-5 h-5 mr-3"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth="2"
                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"
                ></path>
              </svg>
              Hotels
            </Link>
          </li>
          <li>
            <Link
              href={route("amenities.index")}
              className="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors"
            >
              <svg
                className="w-5 h-5 mr-3"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth="2"
                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"
                ></path>
              </svg>
              Amenities
            </Link>
          </li>
          <li>
            <Link
              href={route("room-types.index")}
              className="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors"
            >
              <svg
                className="w-5 h-5 mr-3"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth="2"
                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"
                ></path>
              </svg>
              Room Types
            </Link>
          </li>
          <li>
            <Link
              href={route("reviews.index")}
              className="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors"
            >
              <svg
                className="w-5 h-5 mr-3"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth="2"
                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"
                ></path>
              </svg>
              Reviews
            </Link>
          </li>
        </ul>
      </nav>
    </div>
  );
}
