<template>
  <div id="gallery-carousel">
    <div class="container">
      <h3 class="heading" v-html="heading"></h3>
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    heading: String,
  },
  methods: {
    initSlick() {
      const slickElement = $('.gallery-carousel');
      const totalSlides = $('.gallery-carousel .gallery-item').length;

      slickElement.slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        cssEase: 'linear',
        infinite: false,
        prevArrow:
          '<div class="slider-prev"><i class="fas fa-chevron-left"></i></div>',
        nextArrow:
          '<div class="slider-next"><i class="fas fa-chevron-right"></i></div>',
        responsive: [
          {
            breakpoint: 1400,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
            },
          },
          {
            breakpoint: 992,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
            },
          },
          {
            breakpoint: 769,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
        ],
      });
    },
  },
  mounted() {
    this.initSlick();
  },
};
</script>

<style lang="scss" scoped>
#gallery-carousel {
  background-color: #dedede;
  padding-top: 1.5rem;
  padding-bottom: 1.75rem;
  margin-bottom: 2rem;
  .heading {
    text-transform: uppercase;
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 1.5rem;
  }
  .gallery-carousel {
    display: flex;
    position: relative;
    z-index: 2;
    .image-wrapper {
      position: relative;
      overflow: hidden;
      max-height: 235px;
      max-width: 351px;
      margin: auto;
      @include minw(1400) {
        padding: 0 6px;
      }
      @include maxw(1200) {
        padding: 0 6px;
      }
      img {
        object-fit: cover;
        max-width: 100%;
        height: auto;
      }
    }
  }
}
</style>
