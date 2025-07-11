import Sidebar from "@/Components/partials/navbar/Sidebar";
import Topbar from "@/Components/partials/navbar/Topbar";
import { Head, usePage } from "@inertiajs/react";

export default function AuthLayout({ children }) {
  const { site_title } = usePage().props;
  return (
    <div className="bg-gray-100">
      <Head title={site_title} />
      <Sidebar siteTitle={site_title}></Sidebar>
      {/* <!-- Main Content --> */}
      <div className="lg:ml-64">
        <Topbar></Topbar>
        {/* Main Content Area */}
        <main className="p-6">{children}</main>
      </div>
    </div>
  );
}
