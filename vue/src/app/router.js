/**
 * Created by limx on 17-7-2.
 */
import VueRouter from 'vue-router';
import Vue from 'vue';

const Index = resolve => require(['./components/Index.vue'], resolve);
const Login = resolve => require(['./components/Login.vue'], resolve);
const User = resolve => require(['./components/User.vue'], resolve);
const BaiduTieba = resolve => require(['./components/Baidu/Tieba.vue'], resolve);
const BaiduUser = resolve => require(['./components/Baidu/User.vue'], resolve);
const BaiduEdit = resolve => require(['./components/Baidu/Edit.vue'], resolve);
const Map = resolve => require(['./components/Map.vue'], resolve);
const FootMarkList = resolve => require(['./components/Footmark/List.vue'], resolve);
const FootMarkEdit = resolve => require(['./components/Footmark/Edit.vue'], resolve);
const OauthEdit = resolve => require(['./components/Oauth/Edit.vue'], resolve);
const OauthList = resolve => require(['./components/Oauth/List.vue'], resolve);
const GithubUser = resolve => require(['./components/Github/User.vue'], resolve);
const WeightEdit = resolve => require(['./components/Weight/Edit.vue'], resolve);
const WeightList = resolve => require(['./components/Weight/List.vue'], resolve);

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