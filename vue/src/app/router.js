/**
 * Created by limx on 17-7-2.
 */
import VueRouter from 'vue-router';
import Vue from 'vue';
import Index from './components/Index.vue';
import Login from './components/Login.vue';
import User from './components/User.vue';
import BaiduTieba from './components/Baidu/Tieba.vue';
import BaiduUser from './components/Baidu/User.vue';
import BaiduEdit from './components/Baidu/Edit.vue';
import Map from './components/Map.vue';
import FootMarkList from './components/Footmark/List.vue';
import FootMarkEdit from './components/Footmark/Edit.vue';
import OauthEdit from './components/Oauth/Edit.vue';
import OauthList from './components/Oauth/List.vue';
import GithubUser from './components/Github/User.vue';
import WeightEdit from './components/Weight/Edit.vue';
import WeightList from './components/Weight/List.vue';

Vue.use(VueRouter);

// 2. 定义路由
// 每个路由应该映射一个组件。 其中"component" 可以是
// 通过 Vue.extend() 创建的组件构造器，
// 或者，只是一个组件配置对象。
// 我们晚点再讨论嵌套路由。
const routes = [
    {path: '/', name: 'index', component: Index},
    {path: '/login', name: 'login', component: Login},
    {path: '/user', name: 'user', component: User},
    {path: '/baidu/tieba', name: 'baidu.tieba', component: BaiduTieba},
    {path: '/baidu/user', name: 'baidu.user', component: BaiduUser},
    {path: '/baidu/edit', name: 'baidu.edit', component: BaiduEdit},
    {path: '/map', name: 'map', component: Map},
    {path: '/footmark/list', name: 'footmark.list', component: FootMarkList},
    {path: '/footmark/edit', name: 'footmark.edit', component: FootMarkEdit},
    {path: '/oauth/list', name: 'oauth.list', component: OauthList},
    {path: '/oauth/edit', name: 'oauth.edit', component: OauthEdit},
    {path: '/github/user/:login', name: 'github.user', component: GithubUser},
    {path: '/weight/list', name: 'weight.list', component: WeightList},
    {path: '/weight/edit', name: 'weight.edit', component: WeightEdit},
];

// 3. 创建 router 实例，然后传 `routes` 配置
// 你还可以传别的配置参数, 不过先这么简单着吧。
const router = new VueRouter({
    routes: routes // （缩写）相当于 routes: routes
});

export default router;