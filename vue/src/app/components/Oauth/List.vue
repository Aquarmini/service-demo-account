<template>
    <div id="footmark.list">
        <div class="weui-flex">
            <div class="weui-flex__item">
                <div class="placeholder">
                    <div class="weui-cells">
                        <router-link to="/oauth/edit" class="weui-cell weui-cell_access">
                            <div class="weui-cell__bd">
                                <span style="vertical-align: middle">我的授权列表</span>
                            </div>
                            <div class="weui-cell__ft">新增授权</div>
                        </router-link>
                    </div>
                    <div class="weui-panel weui-panel_access">
                        <div class="weui-panel__hd">授权列表</div>
                        <div class="weui-panel__bd">
                            <div class="weui-media-box weui-media-box_text" v-for="(item,index) in items"
                                 v-on:click="toOauth(item)">
                                <h4 class="weui-media-box__title">{{item.name}}</h4>
                                <!--<p class="weui-media-box__desc">由各种物质组成的巨型球状天体，叫做星球。星球有一定的形状，有自己的运行轨道。</p>-->
                                <ul class="weui-media-box__info">
                                    <li class="weui-media-box__info__meta">类型</li>
                                    <li class="weui-media-box__info__meta weui-media-box__info__meta_extra">
                                        {{item.type_name}}
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
                let router = '/user/oauth/list';
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
            toOauth: function (e) {
                if (e.type == 2) {
                    // Github
                    this.clickGithub(e.name);
                }
            },
            clickGithub: function (login) {
                let that = this;
                weui.actionSheet([
                    {
                        label: '查看信息',
                        onClick: function () {
                            that.$router.push('/github/user');
                        }
                    }, {
                        label: '刷新',
                        onClick: function () {
                            let router = '/user/github/refresh';
                            let token = that.$store.getters.token;
                            let json = {
                                token: token,
                                name: login
                            };
                            api.post(router, json).then(res => {
                                weui.alert('强制刷新成功！');
                            }).catch(res => {
                                weui.alert(res.message);
                            });
                        }
                    }
                ], [
                    {
                        label: '取消',
                    }
                ], {
                    className: 'custom-classname'
                });
            }
        }
    }
</script>