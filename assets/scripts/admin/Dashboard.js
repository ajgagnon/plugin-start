import { useState } from "react";
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

export default function Page() {
  const [currentPage, setCurrentPage] = useState({
    section: "Building Your Application",
    page: "Data Fetching",
  });

  const renderContent = () => {
    const key = `${currentPage.section}-${currentPage.page}`;

    // Different content based on the selected page
    switch (key) {
      case "Getting Started-Installation":
        return (
          <div className="flex flex-1 flex-col gap-4 p-4">
            <h1 className="text-3xl font-bold">Installation</h1>
            <p className="text-muted-foreground">
              Get started with installing the plugin...
            </p>
            <div className="bg-muted/50 min-h-[60vh] flex-1 rounded-xl p-6">
              Installation content goes here
            </div>
          </div>
        );
      case "Getting Started-Project Structure":
        return (
          <div className="flex flex-1 flex-col gap-4 p-4">
            <h1 className="text-3xl font-bold">Project Structure</h1>
            <p className="text-muted-foreground">
              Learn about the project structure...
            </p>
            <div className="bg-muted/50 min-h-[60vh] flex-1 rounded-xl p-6">
              Project structure content goes here
            </div>
          </div>
        );
      case "Building Your Application-Routing":
        return (
          <div className="flex flex-1 flex-col gap-4 p-4">
            <h1 className="text-3xl font-bold">Routing</h1>
            <p className="text-muted-foreground">
              Configure routing in your application...
            </p>
            <div className="bg-muted/50 min-h-[60vh] flex-1 rounded-xl p-6">
              Routing content goes here
            </div>
          </div>
        );
      case "Building Your Application-Data Fetching":
        return (
          <div className="flex flex-1 flex-col gap-4 p-4">
            <div className="grid auto-rows-min gap-4 md:grid-cols-3">
              <div className="bg-muted/50 aspect-video rounded-xl" />
              <div className="bg-muted/50 aspect-video rounded-xl" />
              <div className="bg-muted/50 aspect-video rounded-xl" />
            </div>
            <div className="bg-muted/50 min-h-[100vh] flex-1 rounded-xl md:min-h-min" />
          </div>
        );
      default:
        return (
          <div className="flex flex-1 flex-col gap-4 p-4">
            <h1 className="text-3xl font-bold">{currentPage.page}</h1>
            <p className="text-muted-foreground">
              Content for {currentPage.page} in {currentPage.section}
            </p>
            <div className="bg-muted/50 min-h-[60vh] flex-1 rounded-xl p-6">
              Page content goes here
            </div>
          </div>
        );
    }
  };

  return (
    <div className="rank-ai">
      <SidebarProvider>
        <AppSidebar onNavigate={setCurrentPage} currentPage={currentPage} />
        <SidebarInset>
          <header className="flex h-16 shrink-0 items-center gap-2 border-b px-4 bg-background z-10">
            <SidebarTrigger className="-ml-1 border-0" />
            <Separator
              orientation="vertical"
              className="mr-2 data-[orientation=vertical]:h-4"
            />
            <Breadcrumb>
              <BreadcrumbList className="p-0 m-0">
                <BreadcrumbItem className="!mb-0">
                  <BreadcrumbLink>{currentPage.section}</BreadcrumbLink>
                </BreadcrumbItem>
                <BreadcrumbSeparator className=":marker:hidden" />
                <BreadcrumbItem className="!mb-0">
                  <BreadcrumbPage>{currentPage.page}</BreadcrumbPage>
                </BreadcrumbItem>
              </BreadcrumbList>
            </Breadcrumb>
          </header>
          {renderContent()}
        </SidebarInset>
      </SidebarProvider>
    </div>
  );
}
