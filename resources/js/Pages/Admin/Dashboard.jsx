import AuthLayout from "@/layouts/AuthLayout";
export default function Dashboard() {
  return (
    <AuthLayout>
      <div className="mb-6">
        <h1 className="text-2xl font-bold text-gray-800">Dashboard</h1>
        <p className="text-gray-600">Welcome to your admin dashboard</p>
      </div>

      {/* <!-- Content Section - Left blank for customization --> */}
      <div className="bg-white rounded-lg shadow-sm border border-gray-200 p-6 min-h-96">
        {/* <!-- Your content goes here --> */}
        <div className="text-center text-gray-500 py-12">
          <p className="text-lg">Content area ready for customization</p>
          <p className="text-sm mt-2">
            Add your components, charts, tables, or any other content here
          </p>
        </div>
      </div>
    </AuthLayout>
  );
}
