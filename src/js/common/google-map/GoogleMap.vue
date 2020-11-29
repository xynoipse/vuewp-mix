<template>
  <div class="google-map" ref="map">
    <slot />
  </div>
</template>

<script>
import eventBus from '@js/utils/eventBus';

export default {
  name: 'GoogleMap',
  provide() {
    return {
      gmap: new Promise((resolve, reject) => {
        this.$mapPromiseDeferred = { resolve, reject };
      }),
    };
  },
  props: {
    center: {
      default() {
        return {
          lat: 14.55272,
          lng: 121.05268,
        };
      },
    },
    lat: {
      default() {
        return 14.55272;
      },
    },
    lng: {
      default() {
        return 121.05268;
      },
    },
    zoom: {
      default: 9,
      type: Number,
    },
    mapType: {
      default: 'roadmap',
      type: String,
    },
  },
  data: () => ({
    map: null,
  }),
  mounted() {
    const vm = this;
    this.map = new google.maps.Map(this.$refs['map'], {
      zoom: this.zoom,
      center: this.center,
      mapTypeId: this.mapType,
    });

    this.$mapPromiseDeferred.resolve(this.map);
    this.map.addListener('zoom_changed', function () {
      vm.$emit('zoom_changed', vm.map.getZoom());
    });

    this.$emit('onLoadMap', this.map);

    this.showCurrentLocation();
  },
  methods: {
    setCenter(coordinate) {
      this.map.setCenter(coordinate);
    },
    showCurrentLocation() {
      eventBus.$on('currentLocation', (data) => {
        let g = this.map;
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(
            function (position) {
              var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
              };
              g.setCenter(pos);
            },
            function () {}
          );
        } else {
          alert("Browser doesn't support Geolocation");
        }
      });
    },
  },
  watch: {
    // center(n){
    //     this.map.setCenter(n)
    // },
    lat(lat) {
      this.map.setCenter({ lat, lng: this.lng });
    },
    lng(lng) {
      this.map.setCenter({ lat: this.lat, lng });
    },
    zoom(n) {
      this.map.setZoom(n);
    },
  },
};
</script>
<style scoped>
.google-map {
  width: 100%;
  min-height: 100%;
}
</style>
