<template>
  <fragment>
    <div class="container-fluid footer-copyright">
      <div class="row footer-copyright-row">
        <div class="col-lg-12 col-md-12">
          <p>
            Copyright © 2020 {{ siteName }}. All rights reserved. VueWP Mix by
            <a href="https://github.com/xynoipse">Jason</a>.
          </p>
        </div>
      </div>
    </div>
  </fragment>
</template>

<script>
export default {
  props: {
    'site-name': String,
  },
};
</script>
