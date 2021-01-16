window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

axios.defaults.withCredentials = true;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'
//
// window.Pusher = require('pusher-js');
//
// let PUSHER_APP_KEY = document.head.querySelector('meta[name="PUSHER_APP_KEY"]');
// let PUSHER_APP_CLUSTER = document.head.querySelector('meta[name="PUSHER_APP_CLUSTER"]');
// let PUSHER_APP_HOST = document.head.querySelector('meta[name="PUSHER_APP_HOST"]');
// let PUSHER_APP_PORT = document.head.querySelector('meta[name="PUSHER_APP_PORT"]');
//
// window.Echo = new Echo({
//   broadcaster: 'pusher',
//   key: PUSHER_APP_KEY ? PUSHER_APP_KEY.content : process.env.MIX_PUSHER_APP_KEY,
//   cluster: PUSHER_APP_CLUSTER ? PUSHER_APP_CLUSTER.content : process.env.MIX_PUSHER_APP_CLUSTER,
//   wsHost: PUSHER_APP_HOST ? PUSHER_APP_HOST.content : process.env.MIX_PUSHER_APP_HOST,
//   wsPort: PUSHER_APP_PORT ? PUSHER_APP_PORT.content : process.env.MIX_PUSHER_APP_PORT,
//   wssPort: PUSHER_APP_PORT ? PUSHER_APP_PORT.content : process.env.MIX_PUSHER_APP_PORT,
//   disableStats: true,
// });
