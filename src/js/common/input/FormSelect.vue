<template>
  <!-- :selected = "value === option.value" -->
  <select
    class="form-control"
    @change="$emit('input', $event.target.value)"
    :placeholder="placeholder"
    :value="value"
  >
    <option value="" selected disabled>{{ placeholder }}</option>
    <option v-for="(option, key) in _options" :value="option.value" :key="key">
      {{ option.text }}
    </option>
  </select>
</template>

<script>
export default {
  name: 'FormSelect',

  props: {
    value: String | Number,
    placeholder: { type: String, default: 'Select One' },
    options: { type: Array },
  },

  computed: {
    _options() {
      return this.options.map((option) => {
        if (typeof option === 'string') return { value: option, text: option };

        return option;
      });
    },
  },
};
</script>