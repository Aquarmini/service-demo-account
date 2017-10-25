<template>
    <div id="map" style="height: 100%">
        <el-amap ref="map" vid="amap" :amap-manager="amapManager" :center="center" :zoom="zoom" :plugin="plugin"
                 :events="events" class="amap-demo">
            <el-amap-marker v-for="marker in markers" :position="marker.position" :events="marker.events">
            </el-amap-marker>
            <el-amap-info-window v-for="window in windows" :position="window.position" :visible="window.visible"
                                 :content="window.content">
            </el-amap-info-window>
        </el-amap>
    </div>
</template>


<script>
    import Vue from 'vue'
    import api from '../../common/api'
    import weui from 'weui.js'
    import {AMapManager} from 'vue-amap'

    let amapManager = new AMapManager();

    export default {
        name: 'map',
        data() {
            let that = this;
            let timeoutId = 0;
            return {
                amapManager,
                zoom: 15,
                center: [121.59996, 31.197646],
                lon: 121.59996,
                lat: 31.197646,
                loaded: false,
                markers: [],
                windows: [],
                events: {
                    init: (o) => {
                        o.getCity(result => {
                            console.log(result)
                        })
                    },
                    'moveend': () => {
                        let center = this.$refs.map.$$getInstance().getCenter();
                        that.lon = center.lng;
                        that.lat = center.lat;
                        if (timeoutId > 0) {
                            clearTimeout(timeoutId);
                        }
                        timeoutId = setTimeout(function () {
                            that.near();
                        }, 1000);
                        console.log(timeoutId);
                    },
                    'zoomchange': () => {
                    },
                    'click': (e) => {
                        console.log(e);
                    }
                },
                plugin: [
                    'ToolBar',
                    {
                        pName: 'Geolocation',
                        events: {
                            init(o) {
                                // o 是高德地图定位插件实例
                                o.getCurrentPosition((status, result) => {
                                    weui.alert(JSON.stringify(result));
                                    if (result && result.position) {
                                        that.lon = result.position.lng;
                                        that.lat = result.position.lat;
                                        that.center = [that.lon, that.lat];
                                        that.loaded = true;
                                        that.$nextTick();
                                        console.log(that.center);
                                        that.near();
                                    }
                                });
                            }
                        }
                    },
                ]
            }
        },
        mounted() {
            if (!this.$store.getters.isLogin) {
                return this.$router.push({name: 'login'});
            }
        },
        methods: {
            near: function () {
                let that = this;
                let router = '/user/footmark/near';
                let token = this.$store.getters.token;
                let json = {
                    token: token,
                    lon: this.lon,
                    lat: this.lat
                };
                api.post(router, json).then(res => {
                    let markers = [];
                    let windows = [];

                    for (let i = 0; i < res.total; i++) {
                        let item = res.items[i];
                        markers.push({
                            position: [item.location.lon, item.location.lat],
                            events: {
                                click() {
                                    that.windows.forEach(window => {
                                        window.visible = false;
                                    });

                                    that.$nextTick(() => {
                                        that.windows[i].visible = true;
                                    });
                                }
                            }
                        });

                        windows.push({
                            position: [item.location.lon, item.location.lat],
                            content: `<div><image src="${item.image}?imageView2/1/w/50/h/50/q/75|imageslim"></image></div>`,
                            visible: false
                        });
                    }

                    this.markers = markers;
                    this.windows = windows;

                    console.log(res);
                }).catch(res => {
                    weui.alert(res.message);
                });
            }
        }
    }
</script>