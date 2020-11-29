<template>
  <label class="control-label">
    <span v-if="required" class="text-danger"> * </span>
    <slot></slot>
  </label>
</template>

<script>
export default {
  name: 'FormLabel',

  props: ['required'],
};
</script>