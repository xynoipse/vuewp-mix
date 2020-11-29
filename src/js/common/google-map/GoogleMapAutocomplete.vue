<template>
  <form-input
    type="text"
    ref="google_search"
    v-model="search"
    placeholder="Search Location"
  />
</template>

<script>
import { FormInput } from '@js/common/input';

export default {
  name: 'GoogleMapAutocomplete',
  components: {
    FormInput,
  },
  props: {
    countryRestriction: {
      default: 'ph',
    },
    types: {
      type: Array,
      default: () => ['geocode'],
    },
  },
  data: () => ({
    autocomplete: null,
    search: null,
    map: null,
  }),
  mounted() {
    this.initSearch();
  },
  methods: {
    initSearch() {
      const vm = this;
      const { Autocomplete } = google.maps.places;
      this.autocomplete = new Autocomplete(this.$refs.google_search.$el, {
        types: this.types,
        componentRestrictions: { country: this.countryRestriction },
      });

      this.autocomplete.addListener('place_changed', () => {
        vm.$emit('placeChanged', vm.autocomplete.getPlace(), this.autocomplete);
      });
    },
  },
};
</script>