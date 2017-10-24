<template>
    <div id="footmark.list">
        <div class="weui-flex">
            <div class="weui-flex__item">
                <div class="placeholder">
                    <div class="weui-cells">
                        <router-link to="/footmark/edit" class="weui-cell weui-cell_access">
                            <div class="weui-cell__bd">
                                <span style="vertical-align: middle">我的足迹</span>
                            </div>
                            <div class="weui-cell__ft">新增足迹</div>
                        </router-link>
                    </div>
                    <div class="weui-panel weui-panel_access">
                        <div class="weui-panel__hd">我的足迹</div>
                        <div class="weui-panel__bd">
                            <a class="weui-media-box weui-media-box_appmsg" v-for="(item,index) in items">
                                <div class="weui-media-box__hd">
                                    <img class="weui-media-box__thumb"
                                         :src="item.image+'?imageView2/1/w/200/h/200/q/75|imageslim'" alt="">
                                </div>
                                <div class="weui-media-box__bd">
                                    <p class="weui-media-box__desc">{{item.message}}</p>
                                    <ul class="weui-media-box__info">
                                        <li class="weui-media-box__info__meta">[{{item.lon}},{{item.lat}}]</li>
                                    </ul>
                                </div>
                            </a>
                        </div>
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

    export default {
        name: 'footmark.list',
        data() {
            return {
                items: []
            }
        },
        mounted() {
            if (!this.$store.getters.isLogin) {
                return this.$router.push({name: 'login'});
            }
            this.list();
        },
        methods: {
            list: function () {
                let that = this;
                let router = '/user/footmark/list';
                let token = this.$store.getters.token;
                let json = {
                    token: token
                };
                api.post(router, json).then(res => {
                    that.items = res;
                    console.log(res);
                }).catch(res => {
                    weui.alert(res.message);
                });
            }
        }
    }
</script>