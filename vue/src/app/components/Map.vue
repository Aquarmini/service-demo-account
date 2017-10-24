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
            return {
                amapManager,
                zoom: 12,
                center: [121.59996, 31.197646],
                lon: 121.59996,
                lat: 31.197646,
                loaded: false,
                markers: [],
                windows: [],
                events: {
                    init: (o) => {
                        console.log(o.getCenter())
                        console.log(this.$refs.map.$$getInstance())
                        o.getCity(result => {
                            console.log(result)
                        })
                    },
                    'moveend': () => {
                    },
                    'zoomchange': () => {
                    },
                    'click': (e) => {
                        alert('map clicked');
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
                                    if (result && result.position) {
                                        that.lon = result.position.lng;
                                        that.lat = result.position.lat;
                                        that.center = [that.lon, that.lat];
                                        that.loaded = true;
                                        that.$nextTick();
                                        console.log(that.center);
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
            this.near();
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
                            content: item.message,
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