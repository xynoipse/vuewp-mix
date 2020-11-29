<template>
  <div class="custom-control custom-switch">
    <slot></slot>
    <label class="custom-control-label" :for="id">
      {{ label }}
    </label>
  </div>
</template>

<script>
export default {
  name: 'FormSwitch',
  props: {
    label: { type: String, required: true },
    id: { type: String, required: true },
  },
};
</script>