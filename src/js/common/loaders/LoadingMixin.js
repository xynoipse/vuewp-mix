export default {
  data() {
    return {
      ref: null,
    };
  },
  methods: {
    processOn(ref) {
      this.ref = ref;
      return this;
    },
    start() {
      return this.$refs[this.ref].start();
    },
    stop() {
      return this.$refs[this.ref].stop();
    },
  },
};
