/**
 * Created by limx on 2017/10/23.
 */
import Vue from 'vue';
// 引入vue-amap
import VueAMap from 'vue-amap';

Vue.use(VueAMap);

// 初始化vue-amap
VueAMap.initAMapApiLoader({
    // 高德的key
    key: '9a67ef17402f90e21773017bd79867f5',
    // 插件集合
    plugin: [
        'AMap.Autocomplete',
        'AMap.PlaceSearch',
        'AMap.Scale',
        'AMap.OverView',
        'AMap.ToolBar',
        'AMap.MapType',
        'AMap.PolyEditor',
        'AMap.CircleEditor'
    ]
});