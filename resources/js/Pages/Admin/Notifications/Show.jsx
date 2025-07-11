import AuthLayout from "@/layouts/AuthLayout";
import { Head, Link } from "@inertiajs/react";

export default function Show({ notification }) {
  return (
    <AuthLayout>
      <Head title="Notification Details" />

      <h1 className="text-2xl font-bold text-gray-800 mb-6">Notification Details</h1>

      <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
        <h2 className="text-xl font-semibold text-gray-700 mb-4">{notification.data.message}</h2>
        {notification.data.link && (
          <p className="text-gray-700 mb-2">
            Link: <a href={notification.data.link} target="_blank" className="text-blue-600 hover:underline">{notification.data.link}</a>
          </p>
        )}
        <p className="text-gray-600 text-sm mb-4">
          Received: {new Date(notification.created_at).toLocaleString()}
        </p>
        <p className="text-gray-600 text-sm">
          Status: {notification.read_at ? "Read" : "Unread"}
        </p>
      </div>

      <div className="mt-6">
        <Link
          href={route("dashboard.index")}
          className="inline-block px-4 py-2 text-sm text-white bg-blue-600 hover:bg-blue-700 rounded"
        >
          ← Back to Dashboard
        </Link>
      </div>
    </AuthLayout>
  );
}
