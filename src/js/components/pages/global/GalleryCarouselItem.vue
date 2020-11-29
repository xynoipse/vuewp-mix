<template>
  <a data-fancybox :href="image">
    <div class="image-wrapper">
      <img :src="image" :alt="alt" />
    </div>
  </a>
</template>

<script>
export default {
  props: {
    data: String,
  },
  data() {
    const data = JSON.parse(this.data);
    return data;
  },
};
</script>

<style lang="scss" scoped>
.image-wrapper {
  display: block;
  img {
    margin: auto;
  }
}
</style>