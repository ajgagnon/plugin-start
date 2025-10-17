import "./admin.css";

import Dashboard from "./Dashboard";
import { createRoot } from "@wordpress/element";

const container = document.getElementById("app");
const root = createRoot(container);
root.render(<Dashboard />);
