<script>
export default {
  name: 'GooglePolygon',
  inject: {
    gmap: {
      default: null,
    },
  },
  provide() {
    this.$polygon = new Promise((resolve, reject) => {
      this.$polygonPromiseDeferred = { resolve, reject };
    });
    return {
      gmap: this.$polygon,
    };
  },
  render(h) {
    return h('div', this.$slots.default);
  },
  data: () => ({ polygon: {} }),
  props: {
    paths: {
      default: null,
      type: Array,
    },
    styling: {
      default() {
        return {
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF0000',
          fillOpacity: 0.0,
        };
      },
    },
  },
  created() {
    this.gmap.then(this.handleCluster);
  },
  methods: {
    handleCluster(map) {
      this.polygon = new google.maps.Polygon({
        paths: this.paths,
        ...this.styling,
      });
      this.polygon.setMap(map);
      this.$polygonPromiseDeferred.resolve(this.polygon);
    },
  },
  watch: {
    paths(p) {
      this.polygon.setPaths(p);
    },
  },
};
</script>