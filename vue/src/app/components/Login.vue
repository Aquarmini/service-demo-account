<template>
    <div id="login">
        <div class="weui-flex">
            <div class="weui-flex__item">
                <div class="placeholder">
                    <div style="height:2em"></div>
                    <div class="weui-cells__title">登录</div>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell">
                            <div class="weui-cell__hd">
                                <label class="weui-label">用户名</label>
                            </div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" type="text" placeholder="用户名" v-model="username">
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd">
                                <label class="weui-label">密码</label>
                            </div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" type="password" placeholder="密码" v-model="password">
                            </div>
                        </div>
                    </div>
                    <div class="weui-btn-area">
                        <a class="weui-btn weui-btn_primary" v-on:click="login" id="showTooltips">登录</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import Vue from 'vue'
    import api from '../../common/api'
    export default {
        name: 'index',
        data () {
            return {
                username: null,
                password: null,
            }
        },
        mounted(){
            console.log(this.$store.getters.token);
        },
        methods: {
            login: function () {
                let router = '/user/login';
                let json = {
                    username: this.username,
                    password: this.password
                };
                api.post(router, json).then(res => {
                    console.log(res);
                });
            }
        }
    }
</script>