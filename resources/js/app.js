import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import FollowButton from './components/followButton.vue';
app.component('follow-button', FollowButton);

app.mount('#app');
