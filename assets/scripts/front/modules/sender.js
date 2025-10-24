/**
 * Network operations for sending rrweb events
 */

import apiFetch from "@wordpress/api-fetch";
import { createPayload } from "./utils";

const ENDPOINT = "/andre-base/v1/events";

/**
 * Sends events in a batch using WordPress API Fetch
 * Handles WordPress nonces and authentication automatically
 * keepalive ensures request completes even during page unload
 * Used for periodic sends and visibility changes
 *
 * @param {string} sessionId - The session identifier
 * @param {Array} events - Array of rrweb events
 * @returns {Promise} API fetch promise
 */
export function sendBatch(sessionId, events) {
  const payload = createPayload(sessionId, events);

  return apiFetch({
    path: ENDPOINT,
    method: "POST",
    data: payload,
    keepalive: true,
  });
}

/**
 * Sends events using sendBeacon for reliability during page unload
 * Used for beforeunload and pagehide events
 * @param {string} sessionId - The session identifier
 * @param {Array} events - Array of rrweb events
 * @returns {boolean} Whether the beacon was successfully queued
 */
export function sendCritical(sessionId, events) {
  const payload = createPayload(sessionId, events);
  const blob = new Blob([JSON.stringify(payload)], {
    type: "application/json",
  });

  return navigator.sendBeacon(ENDPOINT, blob);
}
