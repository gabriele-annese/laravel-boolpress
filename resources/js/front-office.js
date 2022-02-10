//import dependecies
import Vue from 'vue';
import App from './views/App';

import router from './routes';

//init vue instance

const root = new Vue({
    el:'#root',
    router,
    render: h => h(App),
})
