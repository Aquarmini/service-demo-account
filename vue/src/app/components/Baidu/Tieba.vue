<template>
    <div id="tieba">
        <div class="weui-flex">
            <div class="weui-flex__item">
                <div class="placeholder">
                    <div class="weui-panel">
                        <div class="weui-panel__hd">
                            我的百度贴吧列表
                        </div>
                        <div class="weui-panel__bd">
                            <div class="weui-media-box weui-media-box_text" v-for="(item,index) in items">
                                <h4 class="weui-media-box__title">{{item.name}}</h4>
                                <p class="weui-media-box__desc">{{item.slogan}}</p>
                                <ul class="weui-media-box__info">
                                    <li class="weui-media-box__info__meta">{{item.levelName}}</li>
                                    <li class="weui-media-box__info__meta">Lv:{{item.levelId}}</li>
                                    <li class="weui-media-box__info__meta weui-media-box__info__meta_extra">
                                        {{item.curScore}}/{{item.levelupScore}}
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
        name: 'tieba',
        data () {
            return {
                items: []
            }
        },
        mounted(){
            if (!this.$store.getters.isLogin) {
                return this.$router.push({name: 'login'});
            }

            let bdUserId = this.$store.getters.bdUserId;
            if (!bdUserId) {
                return this.$router.replace('/');
            }

            this.list();

        },
        methods: {
            list: function () {
                let that = this;
                let router = '/baidu/tieba/list';
                let token = this.$store.getters.token;
                let json = {
                    token: token,
                    user_baidu_id: this.$store.getters.bdUserId
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