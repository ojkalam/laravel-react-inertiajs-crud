import AuthLayout from "@/layouts/AuthLayout";
import { Head, Link, router } from "@inertiajs/react";

export default function Index({ notifications }) {
  function handleMarkAsRead(notificationId) {
    router.post(
      route("notifications.markAsRead"),
      { id: notificationId },
      {
        preserveScroll: true,
        onSuccess: () => {
          router.reload({ only: ["notifications"] });
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
          router.reload({ only: ["notifications"] });
        },
      }
    );
  }

  return (
    <AuthLayout>
      <Head title="All Notifications" />

      <div className="mb-6">
        <h1 className="text-2xl font-bold text-gray-800">All Notifications</h1>
        <p className="text-gray-600">Manage your notifications</p>
      </div>

      <div className="bg-white rounded-lg shadow-sm border border-gray-200 p-6 min-h-96">
        <div className="flex justify-end mb-4">
          <button
            onClick={handleMarkAllAsRead}
            className="px-4 py-2 text-sm text-blue-600 border border-blue-600 rounded hover:bg-blue-50 transition"
          >
            Mark All as Read
          </button>
        </div>

        {notifications.length > 0 ? (
          <div className="space-y-4">
            {notifications.map((notification) => (
              <div
                key={notification.id}
                className={`p-4 rounded-lg border ${
                  !notification.read_at ? "bg-blue-50 border-blue-200" : "bg-gray-50 border-gray-200"
                }`}
              >
                <div className="flex justify-between items-center">
                  <Link
                    href={route("notifications.show", notification.id)}
                    className="text-lg font-semibold text-gray-800 hover:underline"
                  >
                    {notification.data.message}
                  </Link>
                  {!notification.read_at && (
                    <button
                      onClick={() => handleMarkAsRead(notification.id)}
                      className="text-sm text-green-600 hover:underline"
                    >
                      Mark as Read
                    </button>
                  )}
                </div>
                <p className="text-sm text-gray-600 mt-1">
                  Received: {new Date(notification.created_at).toLocaleString()}
                </p>
                {notification.data.link && (
                  <p className="text-sm text-gray-600 mt-1">
                    Link: <a href={notification.data.link} target="_blank" className="text-blue-600 hover:underline">{notification.data.link}</a>
                  </p>
                )}
              </div>
            ))}
          </div>
        ) : (
          <p className="text-center text-gray-500">No notifications to display.</p>
        )}
      </div>
    </AuthLayout>
  );
}
