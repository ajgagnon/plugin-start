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
  return (
    <div className="rank-ai">
      <header className="flex h-16 shrink-0 items-center gap-2 border-b px-4 bg-background z-10">
        Settings
      </header>
      <div className="flex flex-1 flex-col gap-4 p-4">
        <h1 className="text-3xl font-bold">Installation</h1>
        <p className="text-muted-foreground">
          Get started with installing the plugin...
        </p>
        <div className="bg-muted/50 min-h-[60vh] flex-1 rounded-xl p-6">
          Installation content goes here
        </div>
      </div>
    </div>
  );
}
