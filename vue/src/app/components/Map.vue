<template>
    <div id="map" style="height: 100%">
        <el-amap ref="map" vid="amap" :amap-manager="amapManager" :center="center" :zoom="zoom" :plugin="plugin"
                 :events="events" class="amap-demo">
        </el-amap>
    </div>
</template>


<script>
    import Vue from 'vue'
    import {AMapManager} from 'vue-amap'
    let amapManager = new AMapManager();

    export default {
        name: 'map',
        data () {
            let that = this;
            return {
                amapManager,
                zoom: 12,
                center: [121.59996, 31.197646],
                lng: 0,
                lat: 0,
                loaded: false,
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
                        pName: 'MapType',
                        defaultType: 0,
                        events: {
                            init(o) {
                                console.log(o);
                            }
                        }
                    },
                    {
                        pName: 'Geolocation',
                        events: {
                            init(o) {
                                // o 是高德地图定位插件实例

                                o.getCurrentPosition((status, result) => {
                                    if (result && result.position) {
                                        that.lng = result.position.lng;
                                        that.lat = result.position.lat;
                                        that.center = [that.lng, that.lat];
                                        that.loaded = true;
                                        that.$nextTick();
                                    }
                                });
                            }
                        }
                    },
                ]
            }
        },
        mounted(){
            if (!this.$store.getters.isLogin) {
                return this.$router.push({name: 'login'});
            }
        }
    }
</script>