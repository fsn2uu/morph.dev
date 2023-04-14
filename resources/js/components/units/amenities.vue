<template>
    <div>
      <h3>Available Amenities</h3>
      <div>
        <div v-for="(amenity, index) in amenities" :key="amenity.id">
          <input type="checkbox" :id="'amenity-' + index" :value="amenity.id" v-model="selectedAmenities">
          <label :for="'amenity-' + index">{{ amenity.name }}</label>
        </div>
      </div>
      <button @click="showNewAmenityForm = true">Create New Amenity</button>
      <div v-if="showNewAmenityForm">
        <form @submit.prevent="createNewAmenity">
          <div>
            <label for="new-amenity-name">Name:</label>
            <input type="text" id="new-amenity-name" v-model="newAmenityName">
          </div>
          <button type="submit">Create Amenity</button>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        amenities: [],
        selectedAmenities: [],
        showNewAmenityForm: false,
        newAmenityName: '',
      };
    },
    mounted() {
      // Load available amenities from the API
      this.loadAmenities();
    },
    methods: {
      loadAmenities() {
        // Make an API request to load the available amenities
        axios.get('/api/amenities').then(response => {
          this.amenities = response.data;
        });
      },
      createNewAmenity() {
        // Make an API request to create a new amenity
        axios.post('/api/amenities', {
          name: this.newAmenityName,
          unit_id: this.unitId,
          company_id: this.companyId,
        }).then(response => {
          const newAmenity = response.data;
          this.amenities.push(newAmenity);
          this.selectedAmenities.push(newAmenity.id);
          this.newAmenityName = '';
          this.showNewAmenityForm = false;
        });
      },
    },
    props: {
      unitId: {
        type: Number,
        required: true,
      },
      companyId: {
        type: Number,
        required: true,
      },
    },
  };
  </script>
  