/**
 * rrweb session recording implementation
 * Records user interactions and sends them to the server
 */

import { record } from "rrweb";
import { getOrCreateSessionId } from "./modules/utils";
import { sendBatch, sendCritical } from "./modules/sender";

// Configuration
const FLUSH_INTERVAL = 15000; // 15 seconds
const SIZE_THRESHOLD = 50; // Flush when 50 events accumulated

// State
let events = [];
const sessionId = getOrCreateSessionId();

/**
 * Flushes events to the server using regular fetch
 * Clears the events array after copying data
 */
function flushEvents() {
  if (events.length === 0) return;

  const eventsToSend = [...events];
  events = [];

  sendBatch(sessionId, eventsToSend)
    .then(() => console.log(`Sent ${eventsToSend.length} events`))
    .catch((err) => console.warn("Failed to send events:", err));
}

/**
 * Sends events immediately using sendBeacon for reliability
 * Used during page unload scenarios
 */
function flushCritical() {
  if (events.length === 0) return;

  const success = sendCritical(sessionId, events);
  if (success) {
    console.log(`Queued ${events.length} events via sendBeacon`);
    events = [];
  }
}

// Start recording
record({
  emit(event) {
    events.push(event);

    // Flush if buffer reaches size threshold
    if (events.length >= SIZE_THRESHOLD) {
      flushEvents();
    }
  },
});

// Periodic flush every 15 seconds
setInterval(flushEvents, FLUSH_INTERVAL);

// Handle page unload events (browser close, navigation, etc.)
["beforeunload", "pagehide"].forEach((eventType) => {
  window.addEventListener(eventType, flushCritical);
});

// Handle visibility change (tab switching, minimizing)
document.addEventListener("visibilitychange", () => {
  if (document.hidden && events.length > 0) {
    flushEvents();
  }
});

console.log(`Session recording started: ${sessionId}`);
