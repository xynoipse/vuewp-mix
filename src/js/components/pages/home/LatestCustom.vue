<template>
  <div id="latest-custom">
    <div class="row">
      <custom-item
        v-for="(item, key) in data"
        :key="key"
        :title="item.title"
        :image="item.image"
        :day="item.day"
        :month="item.month"
        :link="item.link"
      ></custom-item>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    data: Array,
  },
};
</script>

<style>
</style>