<template>
  <div class="custom-item col-md-6 col-lg-4">
    <div class="content row">
      <div class="top col-12">
        <div class="custom-date">
          <span class="day" v-html="day"></span>
          <span class="month" v-html="month"></span>
        </div>
        <div class="heading-container">
          <div class="heading">
            <h4 class="title" v-html="title"></h4>
          </div>
        </div>
      </div>
      <div class="bottom col-12">
        <div class="custom-image">
          <img :src="image" :alt="title" />
        </div>
        <div class="read-more">
          <a :href="link" class="button">Read More</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: String,
    image: String,
    day: String,
    month: String,
    link: String,
  },
};
</script>

<style lang="scss" scoped>
.custom-item {
  .content {
    height: 100%;
    text-align: center;
    .top {
      .custom-date {
        color: $main;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: 600;
        margin-bottom: -1.25rem;
        .day {
          font-size: 70px;
          padding-right: 15px;
        }
        .month {
          font-size: 24px;
          text-transform: uppercase;
          padding: 5px 0;
          border-bottom: 3px solid $mainLite;
        }
      }
      .heading-container {
        color: $main;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50%;
        .heading {
          margin-bottom: 0.75rem;
          .title {
            text-align: center;
            font-size: 20px;
            font-weight: 600;
            text-transform: uppercase;
          }
        }
      }
    }
    .bottom {
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      .custom-image {
        position: relative;
        overflow: hidden;
        height: 400px;
        margin-bottom: 1.5rem;
        img {
          object-fit: cover;
          width: 100%;
          height: 100%;
        }
      }
      .read-more {
        .button {
          font-size: 14px;
          text-transform: uppercase;
          font-weight: 600;
          font-family: 'Open Sans';
          padding: 7.5px 30px;
        }
      }
    }
  }
}
</style>