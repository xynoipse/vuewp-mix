<template>
  <div :class="['form-group m-b-0', formClass]">
    <form-label v-if="label" :class="labelClass" :required="required">
      {{ label }}
    </form-label>

    <slot></slot>

    <help-block v-if="error" :class="errorClass">
      {{ error }}
    </help-block>
  </div>
</template>

<script>
export default {
  name: 'FormGroup',

  props: {
    isError: Boolean | String,
    isSuccess: Boolean | String,
    isWarning: Boolean | String,

    label: String,
    labelClass: String,
    required: String,

    error: String,
    errorClass: String,
  },

  computed: {
    formClass() {
      return {
        'has-error': this.isError || this.error !== undefined || false,
        'has-success': this.isSuccess || false,
        'has-warning': this.isWarning || false,
      };
    },
  },
};
</script>