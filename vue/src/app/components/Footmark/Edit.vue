<template>
    <div id="footmark.edit">
        <div class="weui-flex">
            <div class="weui-flex__item">
                <div class="placeholder">
                    <div style="height:2em"></div>
                    <div class="weui-cells__title">足迹新增</div>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell">
                            <div class="weui-cell__hd">
                                <label class="weui-label">昵称</label>
                            </div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" type="text" placeholder="昵称" v-model="nickname">
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd">
                                <label class="weui-label">BDUSS</label>
                            </div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" type="text" placeholder="BDUSS" v-model="bd_uss">
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

    export default {
        name: 'footmark.edit',
        data() {
            return {
                nickname: null,
                bd_uss: null,
            }
        },
        mounted() {
            if (!this.$store.getters.isLogin) {
                return this.$router.push({name: 'login'});
            }
        },
        methods: {
            save: function () {
                let that = this;
                let router = '/baidu/tieba/save';
                let token = this.$store.getters.token;
                let json = {
                    nickname: this.nickname,
                    bd_uss: this.bd_uss,
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