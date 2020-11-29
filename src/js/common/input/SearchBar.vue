<template>
  <div class="input-group searchbar">
    <input
      type="text"
      class="form-control"
      :placeholder="placeholder"
      :value="value"
      @input="$emit('input', $event.target.value)"
    />
    <span class="input-group-btn">
      <button
        type="button"
        class="btn btn-secondary"
        @click="$emit('search', value)"
      >
        {{ searchText }}
      </button>
    </span>
  </div>
</template>

<script>
export default {
  name: 'SearchBar',
  props: {
    placeholder: { default: 'Search Something' },
    searchText: { default: 'Go' },
    value: String,
  },
};
</script>