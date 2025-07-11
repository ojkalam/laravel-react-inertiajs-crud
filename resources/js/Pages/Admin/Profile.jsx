import AuthLayout from "@/layouts/AuthLayout";
import { Head, useForm } from "@inertiajs/react";
import { useState } from "react";

export default function Profile({ user, success, errors }) {
  const { data, setData, processing, put } = useForm({
    name: user.name || "",
    email: user.email || "",
    phone: user.phone || "",
    profile_photo: null,
  });

  const [photoPreview, setPhotoPreview] = useState(null);

  function handleChange(e) {
    const { name, value } = e.target;
    setData(name, value);
  }

  function handlePhotoChange(e) {
    const photo = e.target.files[0];
    if (photo) {
      setData("profile_photo", photo);
      const reader = new FileReader();
      reader.onload = (e) => {
        setPhotoPreview(e.target.result);
      };
      reader.readAsDataURL(photo);
    }
  }

  function clearPhoto() {
    setData("profile_photo", null);
    setPhotoPreview(null);
  }

  function handleSubmit(e) {
    e.preventDefault();
    put(route("profile.update"), data, {
      forceFormData: true,
    });
  }

  return (
    <AuthLayout>
      <Head title="Profile" />

      <h1 className="text-2xl font-bold text-gray-800 mb-6">User Profile</h1>

      {success && (
        <div className="mb-4 p-3 bg-green-100 text-green-800 rounded">
          {success}
        </div>
      )}

      <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
        <form onSubmit={handleSubmit} className="space-y-4 max-w-xl">
          {/* Profile Photo */}
          <div className="flex items-center space-x-4">
            <div className="flex-shrink-0">
              <img
                src={photoPreview || user.profile_photo_url || "https://via.placeholder.com/150"}
                alt="Profile Photo"
                className="h-20 w-20 rounded-full object-cover"
              />
            </div>
            <div>
              <label className="block font-semibold text-gray-700">Profile Photo</label>
              <input
                type="file"
                name="profile_photo"
                className="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                onChange={handlePhotoChange}
              />
              {errors.profile_photo && (
                <p className="text-red-600 text-sm mt-1">{errors.profile_photo}</p>
              )}
              {photoPreview && (
                <button
                  type="button"
                  onClick={clearPhoto}
                  className="mt-2 text-sm text-red-600 hover:underline"
                >
                  Remove Photo
                </button>
              )}
            </div>
          </div>

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
            <label className="block font-semibold text-gray-700">Email</label>
            <input
              type="email"
              name="email"
              className="w-full mt-1 px-3 py-2 border rounded"
              value={data.email}
              onChange={handleChange}
            />
            {errors.email && (
              <p className="text-red-600 text-sm mt-1">{errors.email}</p>
            )}
          </div>

          <div>
            <label className="block font-semibold text-gray-700">Phone</label>
            <input
              type="text"
              name="phone"
              className="w-full mt-1 px-3 py-2 border rounded"
              value={data.phone}
              onChange={handleChange}
            />
            {errors.phone && (
              <p className="text-red-600 text-sm mt-1">{errors.phone}</p>
            )}
          </div>

          <div className="pt-4">
            <button
              type="submit"
              disabled={processing}
              className="px-4 py-2 text-sm text-white bg-blue-600 hover:bg-blue-700 rounded"
            >
              {processing ? "Updating..." : "Update Profile"}
            </button>
          </div>
        </form>
      </div>
    </AuthLayout>
  );
}
