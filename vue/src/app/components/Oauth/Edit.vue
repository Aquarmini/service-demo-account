<template>
    <div id="footmark.edit">
        <div class="weui-flex">
            <div class="weui-flex__item">
                <div class="placeholder">
                    <div style="height:2em"></div>
                    <div class="weui-cells__title">新增授权</div>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell">
                            <div class="weui-cell__hd">
                                <label class="weui-label">名字</label>
                            </div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" type="text" placeholder="名字" v-model="name">
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd">
                                <label class="weui-label">类型</label>
                            </div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" type="text" placeholder="类型" v-model="type">
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd">
                                <label class="weui-label">数据</label>
                            </div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" type="text" placeholder="数据" v-model="code">
                            </div>
                        </div>
                    </div>
                    <div class="weui-btn-area">
                        <a class="weui-btn weui-btn_primary" v-on:click="save" id="showTooltips">保存</a>
                    </div>
                </div>
            </div>
        </div>
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
            return {}
        },
        mounted() {
            if (!this.$store.getters.isLogin) {
                return this.$router.push({name: 'login'});
            }

        },
        methods: {
            save: function () {
                let that = this;
                let router = '/user/oauth/save';
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
            }
        }
    }
</script>