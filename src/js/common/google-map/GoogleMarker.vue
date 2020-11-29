<script>
export default {
  template: '<div><slot/></div>',
  name: 'GoogleMarker',
  inject: {
    gmap: {
      default: null,
    },
  },
  provide() {
    this.$marker = new Promise((resolve, reject) => {
      this.$markerPromiseDeferred = { resolve, reject };
    });
    return {
      $marker: this.$marker,
    };
  },
  props: {
    title: null,
    lat: {
      type: Number,
      default: 0,
    },
    lng: {
      type: Number,
      default: 0,
    },
    draggable: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      pin: null,
      circle: null,
      cluster: null,
      polygon: null,
      center: {
        lat: 0,
        lng: 0,
      },
    };
  },
  methods: {
    addMarker(map) {
      const vm = this;
      map = this._getMap(map);
      const { Marker } = google.maps;
      this.pin = new Marker({
        position: {
          lat: this.lat,
          lng: this.lng,
        },
        map,
        title: this.title,
        draggable: this.draggable,
        // icon: this.path('/app/themes/lordsflock/images/map/map-pin.png'),
        // icon: POINT_MARKER_ICON_CONFIG
      });
      if (this.cluster) {
        console.log(this.pin);
        this.cluster.addMarker(this.pin);
      }

      google.maps.event.addListener(this.pin, 'dragend', (args) =>
        vm.onDragend(args)
      );
      this.pin.addListener('click', () => vm.onClickMarker(map));
      this.$markerPromiseDeferred.resolve(this.pin);
    },
    _getMap(i) {
      /* check if cluster exists */
      if (this.$parent.$cluster) {
        this.cluster = i;
        return i.map;
      }
      if (this.$parent.$polygon) {
        this.polygon = i;
        return i.map;
      }
      return i;
    },
    onDragend({ latLng, ...args }) {
      this.$emit('dragend', latLng, args);
    },
    onClickMarker(map) {
      const marker = this.getInfoWindow();
      if (marker) {
        marker.infoWindow.open(this.map, this.pin);
      }
    },
    getInfoWindow() {
      let infoWindows = this.$children.filter((component) => {
        if (component.constructor.options.name === 'GoogleMarkerInfoWindow')
          return component;
      });
      return infoWindows[0];
    },
    setPinLocation() {
      if (this.pin) {
        this.pin.setPosition(this.center);
      }
    },
  },
  mounted() {
    this.gmap.then(this.addMarker);
  },
  beforeDestroy() {
    this.pin.setMap(null);
  },
  watch: {
    lat(n, o) {
      this.center.lat = n;
      this.setPinLocation();
    },
    lng(n, o) {
      this.center.lng = n;
      this.setPinLocation();
    },
  },
};
</script>