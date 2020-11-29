<template>
  <button type="submit" :class="['btn', 'btn-' + variant]">
    <slot></slot>
  </button>
</template>

<script>
export default {
  name: 'ButtonSubmit',

  props: {
    value: { type: String, default: 'Submit' },
    variant: { type: String, default: 'primary' },
  },
};
</script>