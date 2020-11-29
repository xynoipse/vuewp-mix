<template>
  <select class="form-control" :disabled="disabled"></select>
</template>

<script>
/**
 * This component uses Select2 plugin (https://select2.org)
 */
export default {
  name: 'FormSelectSearch',

  props: {
    value: String | Number,
    disabled: Boolean,
    placeholder: String,
    options: { type: Array },

    ajaxUrl: String,
    ajaxDelay: Number,
    allowClear: Boolean,
    templateResult: Function,
    onProcessAjaxParams: Function,
    onProcessAjaxResponse: Function,
  },

  mounted: function () {
    this.initializeSelector();
  },

  methods: {
    initializeSelector() {
      if ($(this.$el).hasClass('select2-hidden-accessible')) {
        this.destroy();
      }

      const ajax = this.ajaxUrl && {
        url: this.ajaxUrl,
        delay: this.ajaxDelay || 50,
        data: this.onProcessAjaxParams,
        processResults: this.onProcessAjaxResponse,
      };

      $(this.$el)
        .select2({
          ajax: ajax || undefined,
          placeholder: this.placeholder,
          data: !ajax ? this.options : [this.value] || undefined,
          disabled: this.disabled,
          templateResult: this.templateResult,
          allowClear: this.allowClear || false,
        })
        .val((this.value || {}).id || null)
        .trigger('change')
        .on('change', this.handleOnDataSelect.bind(this));
    },

    // Events

    handleOnDataSelect(e) {
      const [data] = $(this.$el).select2('data') || [];
      if ((data || {}).id === (this.value || {}).id) return;
      this.$emit('input', data);
    },

    // Options Manipulation

    addOption(option, isDefaultSelected = false, isSelected = false) {
      const newOption = new Option(
        option.text,
        option.id,
        isDefaultSelected,
        isSelected
      );
      $(this.$el).append(newOption).trigger('change');
    },

    // Value Manipulation

    clearValue() {
      $(this.$el).val(null).trigger('change');
    },

    destroy() {
      $(this.$el).off().select2('destroy');
    },
  },

  watch: {
    value(value = {}) {
      $(this.$el)
        .val(value === null ? null : value.id || null)
        .trigger('change');
    },

    options(value) {
      $(this.$el).html('');
      this.initializeSelector();
    },

    disabled() {
      this.initializeSelector();
    },
  },

  destroyed: function () {
    $(this.$el).off().select2('destroy');
  },
};
</script>