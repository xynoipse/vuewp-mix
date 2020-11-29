<template>
  <div id="custom-lists">
    <slot></slot>
  </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
#custom-lists {
  .custom-lists {
    display: flex;
    justify-content: center;
    margin-bottom: 3rem;
  }
}
</style>