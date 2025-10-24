/**
 * Utility functions for session management and data formatting
 */

const SESSION_STORAGE_KEY = "rank_ai_session_id";

/**
 * Gets existing session ID from localStorage or creates a new one
 * @returns {string} Session ID
 */
export function getOrCreateSessionId() {
  let sessionId = localStorage.getItem(SESSION_STORAGE_KEY);

  if (!sessionId) {
    sessionId = `${Date.now()}-${Math.random().toString(36).substring(2, 11)}`;
    localStorage.setItem(SESSION_STORAGE_KEY, sessionId);
  }

  return sessionId;
}

/**
 * Creates a formatted payload for the API
 * @param {string} sessionId - The session identifier
 * @param {Array} events - Array of rrweb events
 * @returns {Object} Formatted payload
 */
export function createPayload(session_id, events) {
  return {
    session_id,
    events,
  };
}
