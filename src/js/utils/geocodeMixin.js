export default {
  data() {
    return {
      _geocoder: {},
    };
  },
  mounted() {
    this._geocoder = new google.maps.Geocoder();
  },
  methods: {
    geocode(args) {
      return new Promise((resolve, reject) => {
        this._geocoder.geocode(args, (results, status) => {
          if (status === 'OK') {
            resolve(this.getPlaceDetail(results[0]), results[0]);
          }
          reject(status);
        });
      });
    },
    getPlaceDetail(place) {
      let address = {
        city: null,
        country: null,
        state: null,
        province: null,
        street: null,
        formatted_address: null,
        position: {
          lat: null,
          lng: null,
        },
        zipcode: null,
      };

      address.formatted_address = place.formatted_address;
      address.position = {
        lat: place.geometry.location.lat(),
        lng: place.geometry.location.lng(),
      };

      for (let i in place.address_components) {
        let val = place.address_components[i];
        switch (val.types[0]) {
          case 'locality':
            address.city = val.long_name;
            break;
          case 'administrative_area_level_2':
            address.state = val.long_name;
            break;
          case 'administrative_area_level_1':
            address.region = val.long_name;
            break;
          case 'postal_code':
            address.zipcode = val.long_name;
          case 'country':
            address.country = val.long_name;
            break;
          case 'route':
            address.street = val.long_name;
            break;
        }
      }
      return address;
    },
  },
};
