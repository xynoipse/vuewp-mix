/** Bootstrapper */

try {
  window.Popper = require('popper.js').default;
  window.$ = window.jQuery = require('jquery');

  require('bootstrap');
  require('slick-carousel');
  require('@fancyapps/fancybox');
} catch (e) {}
