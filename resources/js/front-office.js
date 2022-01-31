//import dependecies
import Vue from 'vue';
import App from './views/App';

//init vue instance

const root = new Vue({
    el:'#root',
    render: h => h(App),
})
