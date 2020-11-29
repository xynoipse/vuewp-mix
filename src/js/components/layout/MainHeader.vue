<template>
  <fragment>
    <div id="header" class="header-sticky">
      <div class="container-fluid header-container">
        <div class="row main-row">
          <div class="col-lg-2 col-12 logo-col">
            <a :href="link"
              ><img :src="logo" class="img-fluid" :alt="text" />
            </a>
          </div>
          <div class="col-lg-10 menu-col">
            <slot name="main-menu"></slot>
          </div>
          <div class="col-sm-2 col-md-2 col-2 mmenu-col" style="display: none">
            <a href="#mmenu" class="mmenu_mobile">
              <i class="fas fa-bars fa-size"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div id="mobile-header" class="hidden d-none">
      <nav id="mmenu">
        <slot name="mobile-menu"></slot>
      </nav>
    </div>
  </fragment>
</template>

<script>
import scrollHeader from '../../scripts/scrollHeader';
import initMmenu from '../../scripts/mmenu';

export default {
  props: {
    link: String,
    logo: String,
    text: String,
  },
  mounted() {
    scrollHeader();
    initMmenu();
  },
};
</script>
