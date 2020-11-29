<template>
  <select></select>
</template>

<script>
/**
 * This component uses Select2 plugin (https://select2.org)
 */
export default {
  name: 'FormSelectTag',

  props: {
    value: Array,
    options: Array,

    // select2 config, refer to (https://select2.org/configuration/options-api )
    closeOnSelect: { type: Boolean, default: true },
    disabled: Boolean,
    minimumInputLength: { type: Number, default: 0 },
    placeholder: String,
    // function to modify the UI of dropdown items
    onRenderOption: Function,
    // function to modify the UI of dropdown result
    onRenderResult: Function,

    // select2 ajax config
    ajax: Boolean,
    ajaxUrl: String,
    ajaxDelay: Number,
    // function that returns the valid params to pass on api
    onProcessAjaxParams: Function,
    // function that transforms the api response to valid select2 options
    onProcessAjaxResponse: Function,
  },

  mounted: function () {
    $(this.$el)
      .select2(this.selectOptions)
      .val(this.value || [])
      .trigger('change')
      .on('select2:select', this.handleOnDataSelect)
      .on('select2:unselect', this.handleOnDataUnselect);
  },

  computed: {
    selectOptions() {
      const ajax = this.ajax && {
        url: this.ajaxUrl,
        delay: this.ajaxDelay || 50,
        data: this.onProcessAjaxParams,
        processResults: this.onProcessAjaxResponse,
      };

      return {
        ajax: ajax || undefined,
        placeholder: this.placeholder,
        data: !this.ajax ? this.options : undefined,
        multiple: true,
        templateResult: this.onRenderOption,
        templateSelection: this.onRenderResult,
        closeOnSelect: this.closeOnSelect,
        minimumInputLength: this.minimumInputLength,
      };
    },
  },

  methods: {
    // Events

    handleOnDataSelect(e) {
      const { data } = e.params;
      const updatedValue = [...this.value, data.id];
      this.$emit('input', updatedValue);
    },

    handleOnDataUnselect(e) {
      const { data } = e.params;
      const updatedValue = this.value.filter((i) => `${i}` !== data.id);
      this.$emit('input', updatedValue);
    },
  },

  watch: {
    value(newValue) {
      $(this.$el).val(newValue).trigger('change');
    },
  },

  destroyed: function () {
    $(this.$el).off().select2('destroy');
  },
};
</script>