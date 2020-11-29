<template>
  <div class="input-group">
    <span v-if="position == 'left'" class="input-group-addon">
      <i :class="icon" />
    </span>
    <form-input
      :value="value"
      :placeholder="placeholder"
      :name="name"
      @input="$emit('input', $event)"
    />
    <span v-if="position == 'right'" class="input-group-addon">
      <i :class="icon" />
    </span>
  </div>
</template>

<script>
export default {
  name: 'FormIconInput',

  props: {
    icon: { type: String, default: '' },
    position: { type: String, default: 'right' },
    value: String,
    placeholder: String,
  },
};
</script>