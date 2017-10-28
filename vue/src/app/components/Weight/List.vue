<template>
    <div id="footmark.list">
        <div class="weui-flex">
            <div class="weui-flex__item">
                <div class="placeholder">
                    <div class="weui-cells">
                        <router-link to="/weight/edit" class="weui-cell weui-cell_access">
                            <div class="weui-cell__bd">
                                <span style="vertical-align: middle">我的体重列表</span>
                            </div>
                            <div class="weui-cell__ft">新增体重</div>
                        </router-link>
                    </div>
                    <div class="weui-panel weui-panel_access">
                        <div class="weui-panel__hd">体重列表</div>
                        <div class="weui-panel__bd">
                            <div class="weui-media-box weui-media-box_text" v-for="(item,index) in items">
                                <h4 class="weui-media-box__title">{{item.weight}} kg</h4>
                                <ul class="weui-media-box__info">
                                    <li class="weui-media-box__info__meta">时间</li>
                                    <li class="weui-media-box__info__meta weui-media-box__info__meta_extra">
                                        {{item.date}}
                                    </li>
                                </ul>
                            </div>
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
                let router = '/user/weight/index';
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
            },
        }
    }
</script>