<script>
export default {
  name: 'Heading',
  props: {
    size: {
      required: true,
    },
    icon: {
      type: String,
      required: false,
    },
    title: {
      required: true,
    },
  },
  render(createElement) {
    const icon =
      createElement('i', {
        class: `nav-icon ${this.icon} mr-2`,
      }) || null;

    return createElement(`h${this.size}`, [icon, this.title]);
  },
};
</script>