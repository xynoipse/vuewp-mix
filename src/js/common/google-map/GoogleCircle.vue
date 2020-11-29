<script>
import { RADIUS_STYLE } from './utils/mapStyle';

export default {
  name: 'GoogleCircle',
  inject: ['$marker'],
  render(h) {
    return h('div', this.$slots.default);
  },
  props: {
    radius: {
      type: Number,
      require: true,
    },
    styling: {
      type: Object,
      required: false,
      default: () => ({
        ...RADIUS_STYLE,
      }),
    },
    center: {
      require: false,
      type: Object,
    },
    lat: null,
    lng: null,
  },
  data: () => ({
    circle: null,
    position: null,
  }),
  methods: {
    componentWillInit(marker) {
      if (marker) {
        const { lat, lng } = marker.position;
        this.position = {
          lat: lat(),
          lng: lng(),
        };
      }
      const { Circle } = window.google.maps;
      const center = this.position;
      this.circle = new Circle({
        ...this.styling,
        radius: this.radius,
        center,
        map: marker.map,
      });

      if (marker) {
        this.circle.bindTo('center', marker, 'position');
      }
    },
  },
  created() {
    this.$marker.then(this.componentWillInit);
  },
};
</script>