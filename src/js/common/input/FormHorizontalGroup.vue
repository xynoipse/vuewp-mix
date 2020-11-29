<template>
  <div class="form-horizontal">
    <form-group
      :isError="error || isError"
      :isSuccess="isSuccess"
      :isWarning="isWarning"
    >
      <slot name="label">
        <form-label
          v-if="label"
          :class="[labelGridClass, labelClass]"
          :required="required"
        >
          {{ label }}
        </form-label>
      </slot>

      <div :class="[inputGridClass, inputClass]">
        <slot></slot>
        <help-block v-if="error">
          {{ error }}
        </help-block>
      </div>
    </form-group>
  </div>
</template>

<script>
export default {
  name: 'FormHorizontalGroup',

  props: {
    label: { type: String },
    labelGridClass: { type: String, default: 'col-sm-3' },
    labelClass: { type: String },
    inputGridClass: { type: String, default: 'col-sm-9' },
    inputClass: { type: String },

    // form-group props
    isError: Boolean | String,
    isSuccess: Boolean | String,
    isWarning: Boolean | String,
    error: {},

    // form-label props
    required: Boolean,
  },
};
</script>