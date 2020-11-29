<template>
  <div class="modal fade" ref="modal" :id="id">
    <div class="modal-dialog" :class="dialogStyle">
      <div class="modal-content">
        <slot />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Modal',
  props: {
    id: {
      required: false,
    },
    size: null,
    align: null,
  },
  computed: {
    dialogStyle() {
      return {
        'modal-xl': this.size === 'xl',
        'modal-lg': this.size === 'lg',
        'modal-sm': this.size === 'sm',
        'modal-dialog-centered': this.align === 'centered',
      };
    },
  },
  methods: {
    show() {
      $(this.$refs.modal).modal('show');
    },
    close() {
      $(this.$refs.modal).modal('hide');
    },
  },
};
</script>
