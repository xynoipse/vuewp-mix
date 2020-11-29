<template>
  <label>
    <slot> </slot>
    <input
      ref="file"
      type="file"
      class="hidden"
      :accept="accept"
      :name="name"
      :multiple="multiple"
      @change="
        $emit('input', multiple ? $event.target.files : $event.target.files[0])
      "
    />
  </label>
</template>

<script>
export default {
  name: 'FormFileInput',

  props: {
    value: {},
    name: String,
    accept: String,
    multiple: { type: Boolean, default: false },
  },
};
</script>