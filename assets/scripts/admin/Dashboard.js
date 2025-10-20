import { AppSidebar } from "@/components/app-sidebar";
import {
  Breadcrumb,
  BreadcrumbItem,
  BreadcrumbLink,
  BreadcrumbList,
  BreadcrumbPage,
  BreadcrumbSeparator,
} from "@/components/ui/breadcrumb";

import { Separator } from "@/components/ui/separator";
import {
  SidebarInset,
  SidebarProvider,
  SidebarTrigger,
} from "@/components/ui/sidebar";

import { useState } from "react";
export default function Page() {
  const [currentPage, setCurrentPage] = useState({
    section: "Dashboard",
    page: "Overview",
  });

  return (
    <div className="andre-base">
      <SidebarProvider
        style={{
          "--sidebar-width": "calc(var(--spacing) * 72)",
          "--header-height": "calc(var(--spacing) * 12)",
        }}
      >
        <AppSidebar
          variant="inset"
          onNavigate={setCurrentPage}
          currentPage={currentPage}
        />
        <SidebarInset>
          <header className="flex h-16 shrink-0 items-center gap-2 border-b px-4 bg-background z-10">
            <SidebarTrigger className="-ml-1 border-0" />
            <Separator
              orientation="vertical"
              className="mr-2 data-[orientation=vertical]:h-4"
            />
          </header>
          asdf
        </SidebarInset>
      </SidebarProvider>
    </div>
  );
}
