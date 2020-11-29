<template>
  <div>
    <slot class="info-window-content d-none" :pin="pin"></slot>
  </div>
</template>

<script>
export default {
  name: 'GoogleMarkerInfoWindow',
  inject: ['$marker'],
  props: {
    content: null,
  },
  data: () => ({
    infoWindow: null,
    detail: null,
    pin: null,
  }),
  computed: {
    getContent() {
      const content = $(this.$el);
      if (!content) return null;
      return content.html();
    },
  },
  async mounted() {
    const { InfoWindow } = google.maps;
    this.infoWindow = await new InfoWindow({ content: this.getContent });

    this.$marker.then((marker) => {
      this.pin = marker;
    });
  },
};
</script>