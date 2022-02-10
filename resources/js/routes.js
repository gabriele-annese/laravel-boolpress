//dipendenze 
import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './pages/Home';
import About from './pages/About';
import Blog from './pages/Blog';
import PostDetail from './pages/PostDetail';


Vue.use(VueRouter);

const router = new VueRouter({
    mode:'history',
    linkExactActiveClass: 'active',
    routes:[
        {
            path: '/', 
            name: 'home',
            component: Home,
        },
        {
            path: '/about', 
            name: 'about',
            component: About,
        },
        {
            path: '/blog', 
            name: 'blog',
            component: Blog,
        },
        {
            path: '/blog/:slug', 
            name: 'post-detail',
            component: PostDetail,
        },
    ],
});

export default router;