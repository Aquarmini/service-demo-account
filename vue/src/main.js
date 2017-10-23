import Vue from 'vue'
import App from './App.vue'
import router from './app/router'
import amap from './app/amap'
import store from './store'
import 'weui/dist/style/weui.min.css'

new Vue({
    el: '#app',
    router,
    store,
    // template: '<App/>',
    // components: {App},
    render: h => h(App)
})
