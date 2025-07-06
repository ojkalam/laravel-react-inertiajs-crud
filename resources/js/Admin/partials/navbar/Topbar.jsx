import { Link } from "@inertiajs/react";

export default function Topbar() {
  return (
    <header className="bg-white shadow-sm border-b border-gray-200">
      <div className="flex items-center justify-between px-6 py-4">
        <div className="flex items-center">
          {/* <!-- Mobile menu button --> */}
          <button className="lg:hidden text-gray-500 hover:text-gray-700 mr-4">
            <svg
              className="w-6 h-6"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                strokeWidth="2"
                d="M4 6h16M4 12h16M4 18h16"
              ></path>
            </svg>
          </button>

          {/* <!-- Search Bar --> */}
          <div className="relative">
            <input
              type="text"
              placeholder="Search..."
              className="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
            <svg
              className="absolute left-3 top-2.5 w-5 h-5 text-gray-400"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                strokeWidth="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
              ></path>
            </svg>
          </div>
        </div>

        <div className="flex items-center space-x-4">
          {/* <!-- Notifications --> */}
          <button className="relative text-gray-500 hover:text-gray-700">
            <svg
              className="w-6 h-6"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                strokeWidth="2"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
              ></path>
            </svg>
            <span className="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
              3
            </span>
          </button>

          {/* <!-- User Menu --> */}
          <div className="relative">
            <button
              id="userButton"
              className="flex items-center space-x-2 text-gray-700 hover:text-gray-900"
            >
              <img
                src="https://via.placeholder.com/32x32/374151/ffffff?text=A"
                alt="User"
                className="w-8 h-8 rounded-full"
              />
              <span className="hidden md:block">Admin User</span>
              <svg
                className="w-4 h-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth="2"
                  d="M19 9l-7 7-7-7"
                ></path>
              </svg>
            </button>

            {/* User Dropdown */}
            <div
              id="userDropdown"
              className={`absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 hidden z-50`}
            >
              <div className="py-2">
                <a
                  href="#"
                  className="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                >
                  Profile
                </a>
                <a
                  href="#"
                  className="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                >
                  Settings
                </a>
                <div className="border-t border-gray-200 mt-2 pt-2">
                  <a
                    href="#"
                    className="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                  >
                    Sign Out
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
  );
}
