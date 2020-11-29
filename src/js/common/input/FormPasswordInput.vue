<template>
  <div class="input-group">
    <form-input
      :value="value"
      :type="isOpen ? 'text' : 'password'"
      :placeholder="placeholder"
      :name="name"
      @input="$emit('input', $event)"
    />
    <span class="input-group-addon">
      <a @click="toggleViewMode">
        <i class="input-eye" :class="isOpen ? 'eye' : 'eye-slash'" />
      </a>
    </span>
  </div>
</template>

<script>
export default {
  name: 'FormPasswordInput',

  props: {
    name: String,
    value: String,
    placeholder: String,
    type: { default: 'text' },
    value: String,
  },

  data: function () {
    return {
      isOpen: false,
    };
  },

  methods: {
    toggleViewMode() {
      const input = $(this.$el).children('.form-control');
      const currentValue = input.val();
      this.isOpen = !this.isOpen;
      this.$nextTick(() => input.val(currentValue));
    },
  },
};
</script>