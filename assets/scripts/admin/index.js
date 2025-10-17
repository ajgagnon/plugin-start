import App from "./App";
import { createRoot } from "@wordpress/element";
import history from "./router/history";
import "./admin.css";

const menuItems = document.querySelectorAll("#toplevel_page_rank-ai a");
menuItems.forEach((a) => {
  a.addEventListener("click", (e) => {
    e.preventDefault();

    // Remove current class from all menu items
    menuItems.forEach((link) => {
      link.classList.remove("current");
      link.parentElement.classList.remove("current");
    });

    // Add current class to clicked item and its parent li
    e.target.classList.add("current");
    e.target.parentElement.classList.add("current");

    const href = new URL(e.target.href);
    const params = new URLSearchParams(href.search);
    const paramsObject = Object.fromEntries(params);
    history.push(paramsObject);
  });
});

const container = document.getElementById("app");
const root = createRoot(container);
root.render(<App />);
