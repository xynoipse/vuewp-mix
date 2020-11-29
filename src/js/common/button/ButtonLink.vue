<template>
  <a :class="['btn', 'btn-' + variant]">
    <slot></slot>
  </a>
</template>

<script>
export default {
  name: 'ButtonLink',

  props: {
    variant: { type: String, default: 'primary' },
  },
};
</script>