import AuthLayout from "@/layouts/AuthLayout";
import { Head, useForm } from "@inertiajs/react";

export default function Settings({ settings, success, errors }) {
  const { data, setData, post, processing } = useForm({
    site_title: settings.site_title || "",
    contact_email: settings.contact_email || "",
  });

  function handleChange(e) {
    const { name, value } = e.target;
    setData(name, value);
  }

  function handleSubmit(e) {
    e.preventDefault();
    post(route("settings.update"));
  }

  return (
    <AuthLayout>
      <Head title="Settings" />

      <h1 className="text-2xl font-bold text-gray-800 mb-6">Settings</h1>

      {success && (
        <div className="mb-4 p-3 bg-green-100 text-green-800 rounded">
          {success}
        </div>
      )}

      <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
        <form onSubmit={handleSubmit} className="space-y-4 max-w-xl">
          <div>
            <label className="block font-semibold text-gray-700">Site Title</label>
            <input
              type="text"
              name="site_title"
              className="w-full mt-1 px-3 py-2 border rounded"
              value={data.site_title}
              onChange={handleChange}
            />
            {errors.site_title && (
              <p className="text-red-600 text-sm mt-1">{errors.site_title}</p>
            )}
          </div>

          <div>
            <label className="block font-semibold text-gray-700">Contact Email</label>
            <input
              type="email"
              name="contact_email"
              className="w-full mt-1 px-3 py-2 border rounded"
              value={data.contact_email}
              onChange={handleChange}
            />
            {errors.contact_email && (
              <p className="text-red-600 text-sm mt-1">{errors.contact_email}</p>
            )}
          </div>

          <div className="pt-4">
            <button
              type="submit"
              disabled={processing}
              className="px-4 py-2 text-sm text-white bg-blue-600 hover:bg-blue-700 rounded"
            >
              {processing ? "Saving..." : "Save Settings"}
            </button>
          </div>
        </form>
      </div>
    </AuthLayout>
  );
}