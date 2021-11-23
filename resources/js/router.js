import Vue from 'vue';
import Router from 'vue-router';
import VideoList from './components/VideoList.vue';

Vue.use(Router);

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/video-list',
            name: 'VideoList',
            component: VideoList
        }
    ]
});