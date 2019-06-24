import Vue from 'vue';
import VueRouter from 'vue-router';

import Hotels from '@/js/components/Hotels';
import Rooms from '@/js/components/Rooms';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes : [
        {
            path : '/',
            name : 'hotels',
            component: Hotels
        },
        {
            path : '/rooms',
            name : 'rooms',
            component: Rooms
        }
    ]
});
export default router
