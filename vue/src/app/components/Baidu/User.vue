<template>
    <div id="baidu.user">
        <div class="weui-flex">
            <div class="weui-flex__item">
                <div class="placeholder">
                    <div class="weui-cells">
                        <router-link to="/baidu/edit" class="weui-cell weui-cell_access">
                            <div class="weui-cell__bd">
                                <span style="vertical-align: middle">{{nickname}}</span>
                            </div>
                            <div class="weui-cell__ft">新增贴吧账号</div>
                        </router-link>
                    </div>
                    <div class="weui-panel">
                        <div class="weui-panel__hd">
                            我的百度贴吧账号
                        </div>
                        <div class="weui-panel__bd">
                            <div class="weui-media-box weui-media-box_text" v-for="(item,index) in items">
                                <a v-on:click="toTieba(index)" class="weui-media-box__title weui-cell_access">
                                    {{item.tb_nickname}}
                                </a>
                                <ul class="weui-media-box__info">
                                    <li class="weui-media-box__info__meta">{{item.created_at}}</li>
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
        name: 'baidu.user',
        data () {
            return {
                nickname: null,
                items: []
            }
        },
        mounted(){
            if (!this.$store.getters.isLogin) {
                return this.$router.push({name: 'login'});
            }
            this.nickname = this.$store.getters.user.nickname;
            this.list();
        },
        methods: {
            list: function () {
                let that = this;
                let router = '/baidu/tieba/user/list';
                let token = this.$store.getters.token;
                let json = {
                    token: token
                };
                api.post(router, json).then(res => {
                    that.items = res;
                }).catch(res => {
                    weui.alert(res.message);
                });
            },
            toTieba: function (index) {
                let that = this;
                let item = this.items[index];
                let bdUserId = item.id;
                that.$store.dispatch('setBaiduUserId', {bdUserId}).then(function () {
                    that.$router.push('/baidu/tieba');
                });
                console.log(item);
            }
        }
    }
</script>