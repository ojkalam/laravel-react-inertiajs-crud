import { useState, useEffect } from "react";
import { Link, router, usePage } from "@inertiajs/react";

export default function Topbar({ toggleSidebar }) {
  const { auth } = usePage().props;
  const [showUserDropdown, setShowUserDropdown] = useState(false);
  const [showNotificationDropdown, setShowNotificationDropdown] =
    useState(false);
  const [notifications, setNotifications] = useState([]);
  const [unreadCount, setUnreadCount] = useState(0);
  const [searchQuery, setSearchQuery] = useState("");
  const [instanceName, setInstanceName] = useState("");

  useEffect(() => {
    fetchInstanceName();
    fetchNotifications();

    const handleOutsideClick = (event) => {
      if (
        showUserDropdown &&
        !event.target.closest("#userButton") &&
        !event.target.closest("#userDropdown")
      ) {
        setShowUserDropdown(false);
      }
      if (
        showNotificationDropdown &&
        !event.target.closest("#notificationButton") &&
        !event.target.closest("#notificationDropdown")
      ) {
        setShowNotificationDropdown(false);
      }
    };

    document.addEventListener("click", handleOutsideClick);

    return () => {
      document.removeEventListener("click", handleOutsideClick);
    };
  }, [showUserDropdown, showNotificationDropdown]);

  function fetchInstanceName() {
    fetch(route("instance.name"))
      .then((response) => response.json())
      .then((data) => {
        setInstanceName(data.instance);
      })
      .catch((error) => console.error("Error fetching instance name:", error));
  }

  function fetchNotifications() {
    fetch(route("notifications.index"))
      .then((response) => response.json())
      .then((data) => {
        setNotifications(
          data.unreadNotifications.concat(data.readNotifications)
        );
        setUnreadCount(data.unreadNotifications.length);
      })
      .catch((error) => console.error("Error fetching notifications:", error));
  }

  function handleUserButton() {
    setShowUserDropdown(!showUserDropdown);
    setShowNotificationDropdown(false); // Close notification dropdown if open
  }

  function handleNotificationButton() {
    setShowNotificationDropdown(!showNotificationDropdown);
    setShowUserDropdown(false); // Close user dropdown if open
  }

  function handleMarkAsRead(notificationId) {
    router.post(
      route("notifications.markAsRead"),
      { id: notificationId },
      {
        preserveScroll: true,
        onSuccess: () => {
          fetchNotifications(); // Re-fetch to update read status
        },
      }
    );
  }

  function handleMarkAllAsRead() {
    router.post(
      route("notifications.markAllAsRead"),
      {},
      {
        preserveScroll: true,
        onSuccess: () => {
          fetchNotifications(); // Re-fetch to update read status
        },
      }
    );
  }

  function handleLogout() {
    router.post("/logout");
  }

  function handleSearchChange(event) {
    setSearchQuery(event.target.value);
  }

  function handleSearchSubmit(event) {
    if (event.key === "Enter") {
      router.get(route("search.index"), { query: searchQuery });
    }
  }

  return (
    <header className="bg-white shadow-sm border-b border-gray-200">
      <div className="flex items-center justify-between px-6 py-4">
        <div className="flex items-center">
          {/* <!-- Mobile menu button --> */}
          <button
            onClick={toggleSidebar}
            className="text-gray-500 hover:text-gray-700 mr-4"
          >
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
              value={searchQuery}
              onChange={handleSearchChange}
              onKeyDown={handleSearchSubmit}
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
          <strong>{instanceName}</strong>
        </div>

        <div className="flex items-center space-x-4">
          {/* <!-- Notifications --> */}
          <div className="relative">
            <button
              id="notificationButton"
              onClick={handleNotificationButton}
              className="relative text-gray-500 hover:text-gray-700"
            >
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
              {unreadCount > 0 && (
                <span className="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                  {unreadCount}
                </span>
              )}
            </button>

            {/* Notification Dropdown */}
            <div
              id="notificationDropdown"
              className={`absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 ${
                !showNotificationDropdown && "hidden"
              } z-50`}
            >
              <div className="py-2">
                <div className="flex justify-between items-center px-4 py-2 border-b border-gray-200">
                  <h3 className="font-semibold text-gray-800">Notifications</h3>
                  {unreadCount > 0 && (
                    <button
                      onClick={handleMarkAllAsRead}
                      className="text-blue-600 text-sm hover:underline"
                    >
                      Mark all as read
                    </button>
                  )}
                </div>
                {notifications.length > 0 ? (
                  notifications.slice(0, 5).map((notification) => (
                    <Link
                      key={notification.id}
                      href={route("notifications.show", notification.id)}
                      onClick={() => handleMarkAsRead(notification.id)}
                      className={`block px-4 py-3 border-b border-gray-100 ${
                        !notification.read_at
                          ? "bg-blue-50 font-medium"
                          : "hover:bg-gray-50"
                      }`}
                    >
                      <p className="text-sm text-gray-800">
                        {notification.data.message}
                      </p>
                      <p className="text-xs text-gray-500 mt-1">
                        {new Date(notification.created_at).toLocaleString()}
                      </p>
                    </Link>
                  ))
                ) : (
                  <p className="px-4 py-3 text-sm text-gray-500">
                    No new notifications.
                  </p>
                )}
                <div className="border-t border-gray-200 mt-2 pt-2">
                  <Link
                    href={route("notifications.index")}
                    className="block px-4 py-2 text-sm text-blue-600 hover:bg-blue-100"
                  >
                    See All Notifications
                  </Link>
                </div>
              </div>
            </div>
          </div>

          {/* <!-- User Menu --> */}
          <div className="relative">
            <button
              id="userButton"
              onClick={handleUserButton}
              className="flex items-center space-x-2 text-gray-700 hover:text-gray-900"
            >
              <img
                className="h-8 w-8 rounded-full object-cover"
                src={auth.user.profile_photo_url}
                alt={auth.user.name}
              />
              <span className="hidden md:block">{auth.user.name}</span>
            </button>

            {/* User Dropdown */}
            <div
              id="userDropdown"
              className={`absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 ${
                !showUserDropdown && "hidden"
              } z-50`}
            >
              <div className="py-2">
                <Link
                  href={route("profile.index")}
                  className="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                >
                  {" "}
                  Profile{" "}
                </Link>
                <Link
                  href={route("settings.index")}
                  className="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                >
                  {" "}
                  Settings{" "}
                </Link>
                <div className="border-t border-gray-200 mt-2 pt-2">
                  <button
                    onClick={handleLogout}
                    href="#"
                    className="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                  >
                    {" "}
                    Sign Out{" "}
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
  );
}
