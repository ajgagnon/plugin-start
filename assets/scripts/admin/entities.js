import { store as coreStore } from "@wordpress/core-data";
import { dispatch } from "@wordpress/data";
import { __ } from "@wordpress/i18n";
import "./ui/register";

dispatch(coreStore).addEntities([
  {
    name: "events",
    kind: "andre-base",
    label: __("Events", "andre-base"),
    baseURL: "/andre-base/v1/events",
    baseURLParams: { context: "edit" },
  },
]);
