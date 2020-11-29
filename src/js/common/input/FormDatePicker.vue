<template>
  <div class="input-group date" :id="id">
    <input
      type="text"
      class="form-control"
      :name="name"
      :placeholder="placeholder"
      :value="date"
      data-date-format="mm/dd/yyyy"
    />
    <div class="input-group-append">
      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
    </div>
  </div>
</template>

<script>
import moment from 'moment';

export default {
  name: 'FormDatePicker',
  data() {
    return {
      date: this.value,
    };
  },

  props: {
    id: String,
    value: String | Date,
    daysOfWeekDisabled: Array,
    disabledDates: Array,
    viewMode: String,
    name: String,
    placeholder: String,
    format: { type: String, default: 'MM/DD/YYYY hh:mm:ss A' },
    icon: { type: String, default: 'calendar' },
    maxDate: String | Date | Boolean,
    minDate: String | Date | Boolean,
    useCurrent: Boolean,
  },

  mounted: function () {
    // this.loadDatePicker()
    $(`#${this.id}`)
      .datepicker({
        orientation: 'bottom',
        autoclose: true,
        format: 'mm/dd/yyyy',
      })
      .on('changeDate', (e) => {
        this.$emit('input', moment(e.date).add(1, 'days'));
      });
  },

  methods: {
    test() {
      console.log('test');
    },
    loadDatePicker() {
      const element = $(this.$el)
        .datetimepicker({
          date: this.value || null,
          defaultDate: this.value || null,
          daysOfWeekDisabled: this.daysOfWeekDisabled,
          disabledDates: this.disabledDates,
          viewMode: this.viewMode,
          maxDate: this.maxDate ? moment(this.maxDate, this.format) : false,
          minDate: this.minDate ? moment(this.minDate, this.format) : false,
          format: this.format,
        })
        .on('dp.change', this.handleOnDateChange);
    },

    handleOnDateChange({ date }) {
      this.$emit('input', date.toDate());
    },

    setMinDate(minDate) {
      $(this.$el).data('DateTimePicker').minDate(minDate);
    },

    setMaxDate(maxDate) {
      $(this.$el).data('DateTimePicker').maxDate(maxDate);
    },

    clear() {
      $(this.$el).data('DateTimePicker').clear();
    },
  },

  watch: {
    // value(newValue) {
    //    $(this.$el).data('DateTimePicker').viewDate(newValue)
    // }
  },

  beforeDestroy: function () {
    $(this.$el).data('DateTimePicker').destroy();
  },
};
</script>