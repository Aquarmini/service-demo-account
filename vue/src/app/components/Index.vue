<template>
    <div id="index">
        <div class="weui-flex">
            <div class="weui-flex__item">
                <div class="placeholder">
                    <div class="weui-cells">
                        <router-link to="/user" class="weui-cell weui-cell_access">
                            <div class="weui-cell__hd" style="position: relative;margin-right: 10px;">
                                <img :src="avatar" style="width: 50px;display: block">
                            </div>
                            <div class="weui-cell__bd">
                                <p>{{nickname}}</p>
                                <p style="font-size: 13px;color: #888888;">{{username}}</p>
                            </div>
                            <div class="weui-cell__ft"></div>
                        </router-link>
                        <router-link to="/baidu/user" class="weui-cell weui-cell_access">
                            <div class="weui-cell__bd">
                                <span style="vertical-align: middle">Baidu账号</span>
                            </div>
                            <div class="weui-cell__ft"></div>
                        </router-link>
                        <router-link to="/map" class="weui-cell weui-cell_access">
                            <div class="weui-cell__bd">
                                <span style="vertical-align: middle">大地图</span>
                            </div>
                            <div class="weui-cell__ft"></div>
                        </router-link>
                        <router-link to="/footmark/list" class="weui-cell weui-cell_access">
                            <div class="weui-cell__bd">
                                <span style="vertical-align: middle">我的足迹</span>
                            </div>
                            <div class="weui-cell__ft"></div>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import Vue from 'vue'

    export default {
        name: 'index',
        data() {
            return {
                username: null
            }
        },
        mounted() {
            if (!this.$store.getters.isLogin) {
                return this.$router.push({name: 'login'});
            }
            this.username = this.$store.getters.user.username;
            this.nickname = this.$store.getters.user.nickname;
            this.avatar = this.$store.getters.user.avatar;

        }
    }
</script>