<template>
    <div id="github.user">
        <div class="weui-flex">
            <div class="weui-flex__item">
                <div class="placeholder">
                    <div class="weui-cells">
                        <div class="weui-cell">
                            <div class="weui-cell__hd">
                                <img :src="avatar" alt="" style="width:100px;margin-right:5px;display:block">
                            </div>
                            <div class="weui-cell__bd">
                                <p>昵称</p>
                            </div>
                            <div class="weui-cell__ft">{{name}}</div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>登录名</p>
                            </div>
                            <div class="weui-cell__ft">{{login}}</div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>公司名</p>
                            </div>
                            <div class="weui-cell__ft">{{company}}</div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>粉丝数</p>
                            </div>
                            <div class="weui-cell__ft">{{followers}}</div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>关注数</p>
                            </div>
                            <div class="weui-cell__ft">{{following}}</div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>主页</p>
                            </div>
                            <div class="weui-cell__ft">{{html_url}}</div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__bd">
                                <p>公共仓库数</p>
                            </div>
                            <div class="weui-cell__ft">{{public_repos}}</div>
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
        name: 'github.user',
        data() {
            return {
                login: null,
                avatar: null,
                company: null,
                followers: null,
                following: null,
                html_url: null,
                name: null,
                public_repos: 0,
            }
        },
        mounted() {
            if (!this.$store.getters.isLogin) {
                return this.$router.push({name: 'login'});
            }

            let that = this;
            let router = '/user/github/user';
            let token = this.$store.getters.token;
            let name = this.$route.params.login;
            let json = {
                token: token,
                name: name
            };
            api.post(router, json).then(res => {
                that.login = res.login;
                that.avatar = res.avatar_url;
                that.company = res.company;
                that.followers = res.followers;
                that.following = res.following;
                that.html_url = res.html_url;
                that.name = res.name;
                that.public_repos = res.public_repos;
            }).catch(res => {
                weui.alert(res.message, function () {
                    that.$router.back();
                });
            });
        },
        methods: {}
    }
</script>