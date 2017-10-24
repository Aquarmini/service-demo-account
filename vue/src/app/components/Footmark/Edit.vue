<template>
    <div id="footmark.edit">
        <div class="weui-flex">
            <div class="weui-flex__item">
                <div class="placeholder">
                    <div style="height:2em"></div>
                    <div class="weui-cells__title">足迹新增</div>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell" id="uploader">
                            <div class="weui-cell__bd">
                                <div class="weui-uploader">
                                    <div class="weui-uploader__hd">
                                        <p class="weui-uploader__title">图片上传</p>
                                    </div>
                                    <div class="weui-uploader__bd">
                                        <ul class="weui-uploader__files" ref="uploaderFiles" id="uploaderFiles"></ul>
                                        <div class="weui-uploader__input-box">
                                            <input id="uploaderInput" class="weui-uploader__input" type="file"
                                                   accept="image/*" multiple=""/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd">
                                <label class="weui-label">心情</label>
                            </div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" type="text" placeholder="心情" v-model="message">
                            </div>
                        </div>
                    </div>
                    <div class="weui-btn-area">
                        <a class="weui-btn weui-btn_primary" v-on:click="save" id="showTooltips">保存</a>
                    </div>
                </div>
            </div>
        </div>
        <el-amap ref="map" vid="amap" :plugin="plugin"></el-amap>
    </div>
</template>


<script>
    import Vue from 'vue'
    import api from '../../../common/api'
    import weui from 'weui.js'
    import VueAMap from 'vue-amap'

    export default {
        name: 'footmark.edit',
        data() {
            let that = this;
            return {
                image: null,
                message: null,
                lon: null,
                lat: null,
                plugin: [{
                    pName: 'Geolocation',
                    events: {
                        init(o) {
                            // o 是高德地图定位插件实例
                            o.getCurrentPosition((status, result) => {
                                if (result && result.position) {
                                    that.lon = result.position.lng;
                                    that.lat = result.position.lat;
                                    weui.alert(that.lon + "," + that.lat);
                                }
                            });
                        }
                    }
                }]
            }
        },
        mounted() {
            if (!this.$store.getters.isLogin) {
                return this.$router.push({name: 'login'});
            }
            this.upload();
        },
        methods: {
            save: function () {
                let that = this;
                let router = '/user/footmark/save';
                let token = this.$store.getters.token;
                let json = {
                    image: this.image,
                    message: this.message,
                    lon: this.lon,
                    lat: this.lat,
                    token: token
                };
                api.post(router, json).then(res => {
                    that.$router.back();
                }).catch(res => {
                    weui.alert(res.message);
                });
            },
            upload: function () {
                let that = this;
                weui.uploader('#uploader', {
                    url: '/common/image/upload',
                    auto: true,
                    type: 'file',
                    fileVal: 'fileVal',
                    compress: {
                        width: 1600,
                        height: 1600,
                        quality: .8
                    },
                    onBeforeQueued: function (files) {
                        if (["image/jpg", "image/jpeg", "image/png", "image/gif"].indexOf(this.type) < 0) {
                            weui.alert('请上传图片');
                            return false; // 阻止文件添加
                        }
                        if (this.size > 10 * 1024 * 1024) {
                            weui.alert('请上传不超过10M的图片');
                            return false;
                        }
                        if (files.length > 1) { // 防止一下子选择过多文件
                            weui.alert('最多只能上传1张图片，请重新选择');
                            return false;
                        }
                    },
                    onSuccess: function (ret) {
                        if (ret.code !== 0) {
                            // 上传失败
                            weui.alert(ret.message);
                        }
                        that.image = ret.data.image;
                    },
                    onError: function (err) {
                        console.log(this, err);
                        weui.alert(err.message);
                    }
                });
            }
        }
    }
</script>