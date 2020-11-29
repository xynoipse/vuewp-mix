<template>
  <div id="location" class="archive-container">
    <div class="container locator-container">
      <div class="category text-center mb-5">
        <button
          v-for="category in categories.data"
          :key="category.id"
          class="button"
          :class="{ active: categories.selected === category.id }"
          @click="changeCategory(category.id)"
        >
          {{ category.name }}
        </button>
      </div>
      <div class="row locations">
        <div class="locations-content col-lg-4 col-md-12">
          <div class="heading">
            <h3 class="title">Find A Location</h3>
          </div>
          <div class="search-form">
            <google-map-autocomplete
              v-model="googleMap.search"
              @placeChanged="changedPlace"
              class="search-location"
              :countryRestriction="countryRestriction"
              :key="`cR-${countryRestriction}`"
            />
          </div>
          <div class="locations-list">
            <div class="locations-wrapper">
              <div v-if="!loading">
                <div
                  class="location"
                  v-for="location in locations"
                  :key="location.id"
                  @click="showLocation(location)"
                >
                  <div class="name" v-html="location.title.rendered"></div>
                </div>
                <span class="text" v-if="locations.length <= 0">
                  No locations found.
                </span>
              </div>
              <span class="text" v-if="loading">Loading...</span>
            </div>
          </div>
        </div>
        <div class="location-map col-lg-8 col-md-12 col-sm-12">
          <loading ref="map" class="d-none" />
          <google-map
            :zoom="googleMap.zoom"
            :center="googleMap.center"
            :lat="googleMap.center.lat"
            :lng="googleMap.center.lng"
            ref="googlemap"
          >
            <google-marker
              v-for="location in locations"
              :key="location.id"
              :lat="location.acf.location_map_address.lat"
              :lng="location.acf.location_map_address.lng"
              :draggable="false"
            >
              <google-marker-info-window>
                <div class="iw-container">
                  <div class="address-text">
                    {{ getLocationAddress(location) }}
                  </div>
                  <p class="info">
                    {{ location.acf.location_info }}
                  </p>
                  <a
                    :href="getDirections(location)"
                    class="button"
                    target="_blank"
                  >
                    GET DIRECTIONS
                  </a>
                </div>
              </google-marker-info-window>
            </google-marker>
          </google-map>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import * as map from '@js/common/google-map';
import { loadingMixin, loading } from '@js/common/loaders';
import geocodeMixin from '@js/utils/geocodeMixin';
import eventBus from '@js/utils/eventBus';
import request from '@js/utils/request';
import to from '@js/utils/asyncAwait';

export default {
  mixins: [loadingMixin, geocodeMixin],
  components: {
    ...map,
    loading,
  },
  data: () => ({
    googleMap: {
      search: null,
      geocoder: null,
      center: {
        lat: 12.879721,
        lng: 121.774017,
      },
      zoom: 6,
      paths: null,
      heatPoints: null,
    },
    locations: [],
    categories: {
      data: [],
      selected: '',
    },
    countryRestriction: '',
    loading: true,
  }),
  methods: {
    async getCategories() {
      const [res, err] = await to(
        request.get('wp/v2/locations-categories?_fields=id,count,slug,name')
      );
      this.categories.data = res;
      this.categories.selected = res[0].id;

      this.getCountryRestriction();
      this.getLocations();
    },
    async getLocations() {
      this.locations = [];
      const [res, err] = await to(
        request.get(
          `wp/v2/location?_fields=id,title,link,acf&locations-categories=${this.categories.selected}`
        )
      );
      this.locations = res;
      this.loading = false;
    },
    showLocation(location) {
      const googlemap = this.$refs.googlemap;
      const { lat: lLat, lng: lLng } = location.acf.location_map_address;

      googlemap.$children.forEach((marker) => {
        const { lat, lng } = marker;

        marker.getInfoWindow().infoWindow.close();
        if (lat === lLat && lng === lLng) {
          marker.onClickMarker();
        }
      });
      const { lat, lng } = location.acf.location_map_address;
      googlemap.map.setZoom(13);
      googlemap.map.panTo({ lat, lng });
    },
    changedPlace({ geometry, place_id }) {
      this.processOn('map').start();
      this.geocode({ placeId: place_id })
        .then((d) => d)
        .then(({ city, position, state }) => {
          const { lat, lng } = position;

          this.googleMap.center.lat = lat;
          this.googleMap.center.lng = lng;
          this.zoom = 13;
        })
        .catch((e) => {
          console.log(e);
        })
        .finally(() => this.processOn('map').stop());
    },
    getLocationAddress(location) {
      if (!location.acf.location_address_text) {
        const loc = location.acf.location_map_address;
        const { name, street_name_short, city } = loc;
        return `${name}, ${street_name_short}, ${city}`;
      }

      return location.acf.location_address_text;
    },
    changeCategory(categoryId) {
      if (this.categories.selected === categoryId) return;
      this.loading = true;
      this.categories.selected = categoryId;
      this.getLocations();
      this.getCountryRestriction();
    },
    getCountryRestriction() {
      const { selected, data } = this.categories;
      const idx = data.findIndex((d) => d.id === selected);
      if (data[idx].slug === 'philippines')
        return (this.countryRestriction = 'ph');
      return (this.countryRestriction = []);
    },
    getDirections(location) {
      const { address, lat, lng } = location.acf.location_map_address;
      return `https://www.google.com/maps/dir//${address}/@${lat},${lng},17z`;
    },
  },
  mounted() {
    this.getCategories();
  },
};
</script>

<style lang="scss" scoped>
#locations {
  .locator-container {
    .category {
      .button {
        padding: 7px 35px;
        text-transform: uppercase;
        font-weight: 600;
        &:not(:last-child) {
          @include minw(576) {
            margin-right: 3rem;
          }
          margin-right: 0.25rem;
          margin-bottom: 0.5rem;
        }
      }
      .active {
        border-color: $main;
        color: $main;
        background: transparent;
      }
    }
    .locations {
      .locations-content {
        @include maxw(991) {
          margin-bottom: 1rem;
        }
        .heading {
          .title {
            color: $dark;
            font-family: 'Montserrat';
            font-size: 25px;
            font-weight: 700;
            text-transform: uppercase;
          }
        }
        .search-form {
          margin-bottom: 1rem;
          input {
            border: 3px solid #e0e0e0;
            border-radius: 20px;
          }
        }
        .locations-list {
          border: 3px solid #e0e0e0;
          border-radius: 10px;
          padding-right: 7px;
          padding-top: 10px;
          padding-bottom: 10px;
          .locations-wrapper {
            height: 459px;
            max-height: 409px;
            overflow-y: auto;
            @include maxw(991) {
              height: 200px;
            }
            .location {
              cursor: pointer;
              .name {
                text-transform: uppercase;
                font-weight: 600;
                padding: 0.25rem 15px;
              }
              &:hover {
                background: #eaeaea;
              }
            }
            .text {
              padding-left: 12px;
            }
            &::-webkit-scrollbar-track {
              background-color: $gray !important;
            }
            &::-webkit-scrollbar-thumb {
              border-radius: 0 !important;
            }
          }
        }
      }
      .location-map {
        .google-map {
          border: 3px solid $lightGray;
          height: 450px;
          @include maxw(576) {
            height: 350px;
          }
          .iw-container {
            font-size: 14px;
            font-family: 'Montserrat';
            .address-text {
              margin-bottom: 0.65rem;
            }
            .info {
              margin-bottom: 0.75rem;
            }
            .button {
              font-family: 'Open Sans';
              font-weight: 700;
              font-size: 12px;
              background: #fff;
              color: #000;
              padding: 6px 15px;
            }
          }
        }
      }
    }
  }
}
</style>
