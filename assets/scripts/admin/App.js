import { RouterProvider } from "./router";
import Routes from "./Routes";
// import Notices from "./components/Notices";
import ErrorBoundary from "@/components/error-boundary";
// import UnsavedChangesWarning from "./components/unsaved-changes-warning";

const App = () => {
  return (
    <>
      <ErrorBoundary>
        {/* <UnsavedChangesWarning />
        <Notices /> */}
        <RouterProvider>
          <Routes />
        </RouterProvider>
      </ErrorBoundary>
    </>
  );
};

export default App;
