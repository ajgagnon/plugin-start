import { useLocation } from "./router";
import Dashboard from "./Dashboard";
import Settings from "./Settings";

const pages = {
  "andre-base": <Dashboard />,
  "andre-base-settings": <Settings />,
};

export default function Routes() {
  const location = useLocation();

  return pages?.[location?.params?.page] || <Dashboard />;
}
