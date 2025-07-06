import Sidebar from "@/Admin/partials/navbar/Sidebar";
import Topbar from "@/Admin/partials/navbar/Topbar";

export default function AuthLayout({ children }) {
  return (
    <div className="bg-gray-100">
      <Sidebar></Sidebar>
      {/* <!-- Main Content --> */}
      <div className="lg:ml-64">
        <Topbar></Topbar>
        {/* Main Content Area */}
        <main className="p-6">{children}</main>
      </div>
    </div>
  );
}
