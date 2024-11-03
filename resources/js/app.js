import './bootstrap';

import { createApp } from 'vue';

import Navbar from './components/Navbar.vue';
import Movies from './components/Movies.vue';
import Booking from './components/Booking.vue';
import Confirmation from './components/Confirmation.vue';
import Return from './components/Return.vue';

const app = createApp();

app.component('navbar', Navbar);
app.component('movies', Movies);
app.component('booking', Booking);
app.component('confirmation', Confirmation);
app.component('return', Return);

app.mount('#app');
