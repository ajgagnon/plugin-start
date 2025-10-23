import { record } from "rrweb";

let events = [];

console.log("frontend test");
record({
  emit(event) {
    // push event into the events array
    events.push(event);
  },
});

// this function will send events to the backend and reset the events array
function save() {
  const body = JSON.stringify({ events });
  events = [];
  console.log({ body });
}

// save events every 10 seconds
setInterval(save, 10 * 1000);
