<template>
  <fragment>
    <div class="heading-search mb-4">
      <h2 class="heading" v-html="headingText"></h2>
      <form @submit.prevent="onSearch" class="search-bar">
        <div class="search-input">
          <input type="text" v-model="search.input" />
        </div>
        <button type="submit" class="search-button">
          <i class="fas fa-search"></i>
        </button>
      </form>
    </div>
    <slot v-if="!search.searched"></slot>
    <div id="custom-post-search" class="container" v-if="search.searched">
      <div class="custom-list mb-5 row">
        <custom-item
          v-for="(item, key) in search.result"
          :key="key"
          :title="item.title.rendered"
          :image="item._embedded['wp:featuredmedia'][0].source_url"
          :link="item.link"
        ></custom-item>
      </div>
    </div>
  </fragment>
</template>

<script>
import request from '@js/utils/request';
import to from '@js/utils/asyncAwait';
import getUnique from '@js/utils/getUnique';

export default {
  data: () => ({
    headingText: 'Custom Posts',
    postType: 'custom-post',
    search: {
      input: '',
      searched: false,
      result: [],
      lastSearch: '',
    },
  }),
  methods: {
    async onSearch() {
      if (!this.search.input) return;
      if (this.search.input === this.search.lastSearch) return;

      const { input: search } = this.search;

      this.headingText = 'Searching...';
      this.search.result = [];
      this.search.searched = true;
      this.search.lastSearch = search;

      let results = [];
      let [res, err] = await to(
        request.get(
          `wp/v2/${this.postType}?_fields=id,title,acf,excerpt,_links&_embed&search=${search}`
        )
      );
      if (res.length) results = res;

      let data = new FormData();
      data.append('action', 'customPostSearch');
      data.append('data', JSON.stringify({ search }));
      [res, err] = await to(request.post(ajaxUrl, data));
      if (res.length) results = [...results, ...res];

      if (!results.length) return (this.headingText = 'No Results Found.');

      this.headingText = 'Search Results';
      this.search.result = getUnique(results, 'id');
    },
  },
};
</script>

<style lang="scss" scoped>
#custom-post-search {
  min-height: 400px;
}
</style>