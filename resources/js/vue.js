import { createApp } from "vue";
import AmenitiesComponent from './components/units/amenities.vue';

const app = new Vue({
    el: '#app',
    components: {
        AmenitiesComponent
    }
});
app.mount("#app")