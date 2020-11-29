<template>
  <textarea
    :class="classtype"
    :placeholder="placeholder"
    :value="value"
    :required="required"
    :cols="cols"
    :rows="rows"
    @input="$emit('input', $event.target.value)"
  ></textarea>
</template>

<script>
export default {
  name: 'FormTextArea',
  props: {
    placeholder: String,
    value: String | Number,
    required: { type: Boolean, default: false },
    classtype: { type: String, default: 'form-control' },
    rows: String,
    cols: String,
  },
};
</script>