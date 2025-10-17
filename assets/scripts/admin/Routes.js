import { useLocation } from "./router";
import Dashboard from "./Dashboard";
import Settings from "./Settings";

const pages = {
  "rank-ai": <Dashboard />,
  "rank-ai-settings": <Settings />,
};

export default function Routes() {
  const location = useLocation();

  return pages?.[location?.params?.page] || <Dashboard />;
}
