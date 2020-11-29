<template>
  <input
    :type="type"
    :placeholder="placeholder"
    class="form-control"
    :value="value"
    :required="required"
    @input="$emit('input', $event.target.value)"
  />
</template>

<script>
export default {
  name: 'FormInput',

  props: {
    placeholder: String,
    type: { type: String, default: 'text' },
    value: String | Number,
    required: { type: Boolean, default: false },
  },
};
</script>