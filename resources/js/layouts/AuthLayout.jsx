import Sidebar from "@/Components/partials/navbar/Sidebar";
import Topbar from "@/Components/partials/navbar/Topbar";
import { Head, usePage } from "@inertiajs/react";
import { useState, useEffect } from "react";

export default function AuthLayout({ children }) {
  const { site_title } = usePage().props;
  const [isSidebarOpen, setSidebarOpen] = useState(() => {
    const savedSidebarState = localStorage.getItem("sidebar_state");
    return savedSidebarState !== null ? JSON.parse(savedSidebarState) : true;
  });

  const toggleSidebar = () => {
    setSidebarOpen(prevState => {
      const newState = !prevState;
      localStorage.setItem("sidebar_state", JSON.stringify(newState));
      return newState;
    });
  };

  return (
    <div className="bg-gray-100">
      <Head title={site_title} />
      <Sidebar siteTitle={site_title} isSidebarOpen={isSidebarOpen} />
      {/* <!-- Main Content --> */}
      <div className={`transition-all duration-300 ${isSidebarOpen ? 'lg:ml-64' : 'lg:ml-0'}`}>
        <Topbar toggleSidebar={toggleSidebar} />
        {/* Main Content Area */}
        <main className="p-6">{children}</main>
      </div>
    </div>
  );
}
