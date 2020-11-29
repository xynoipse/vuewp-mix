/**
 * Async await wrapper for easy error handling without try-catch
 *
 * @param {Promise} promise
 * @returns {Promise} [undefined, data]
 * @returns {Promise} [error, undefined]
 */

const to = (promise) => {
  return promise
    .then((data) => [data])
    .catch((error) => Promise.resolve([undefined, error]));
};

export default to;
