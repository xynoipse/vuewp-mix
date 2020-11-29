/**
 * Global App Mixin
 */

import Vue from 'vue';

Vue.mixin({
  methods: {
    path: (name) => `${window.publicPath}${name}`,
  },
});
