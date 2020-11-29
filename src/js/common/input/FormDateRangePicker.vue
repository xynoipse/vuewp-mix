<template>
  <input
    type="text"
    class="form-control"
    :name="name"
    :placeholder="placeholder"
  />
</template>

<script>
import moment from 'moment';

export default {
  name: 'FormDateRangePicker',

  props: {
    value: { type: Object, default: () => ({}) },
    placeholder: String,
    name: String,
    // format of the string to display
    format: { type: String, default: 'MM/DD/YYYY' },
    // minimum selectable date
    minDate: Date,
    // maximum selectable date
    maxDate: Date,
    // minimum selectable year
    minYear: Number,
    // maximum selectable year
    maxYear: Number,
    // includes predefined date ranges
    ranges: Object,
    // maximum span of range (in days)
    maxSpan: Number,
    // auto update input when value changed
    autoUpdate: { type: Boolean, default: true },
    // hide the apply and cancel buttons, and automatically apply a new date range as soon as two dates are clicked.
    autoApply: { type: Boolean, default: false },
    // includes time on daterange
    includeTime: { type: Boolean, default: false },
    icon: { type: String, default: 'glyphicon-calendar' },

    openAt: { default: 'center' },
    single: { type: Boolean, default: false },
    showDropDowns: { type: Boolean, default: false },
  },

  mounted: function () {
    this.loadDateRangePicker();
  },

  methods: {
    loadDateRangePicker() {
      $(this.$el)
        .daterangepicker({
          autoUpdateInput: this.autoUpdateInput,
          startDate: this.value.startDate,
          endDate: this.value.endDate,
          ranges: this.ranges,
          timePicker: this.includeTime,
          autoApply: this.autoApply,
          minYear: this.minYear,
          maxYear: this.maxYear,
          maxSpan: this.maxSpan ? { days: this.maxSpan } : undefined,
          locale: { format: this.format },
          opens: this.openAt,
          showDropdowns: this.showDropDowns,
          singleDatePicker: this.single,
        })
        .on('apply.daterangepicker', this.handleOnValueChange);
    },

    handleOnValueChange(event, picker) {
      if (!this.autoUpdateInput) {
        this.fillDateInput(picker.startDate, picker.endDate);
      }

      this.$emit('input', {
        startDate: picker.startDate.toDate(),
        endDate: picker.endDate.toDate(),
      });
    },

    fillDateInput(startDate, endDate) {
      if (startDate && endDate)
        $(this.$el).val(
          `${moment(startDate).format(this.format)} - ${moment(endDate).format(
            this.format
          )}`
        );
      else $(this.$el).val('');
    },
  },

  watch: {
    value(newValue = {}) {
      const { startDate, endDate } = newValue;

      if (!this.autoUpdateInput) {
        this.fillDateInput(startDate, endDate);
      }

      $(this.$el).data('daterangepicker').setStartDate(startDate);
      $(this.$el).data('daterangepicker').setEndDate(endDate);
    },

    minDate() {
      this.loadDateRangePicker();
    },

    maxDate() {
      this.loadDateRangePicker();
    },
  },

  beforeDestroy: function () {
    $(this.$el).data('daterangepicker').remove();
  },
};
</script>
