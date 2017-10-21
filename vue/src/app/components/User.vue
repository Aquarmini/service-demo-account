<template>
    <div id="user">
        <div class="weui-flex">
            <div class="weui-flex__item">
                <div class="placeholder">
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell">
                            <div class="weui-cell__hd">
                                <label class="weui-label">昵称</label>
                            </div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" type="text" v-model="nickname" placeholder="请输入昵称">
                            </div>
                        </div>
                    </div>
                    <div class="weui-btn-area">
                        <a class="weui-btn weui-btn_primary" v-on:click="save">保存</a>
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
        name: 'user',
        data () {
            return {
                nickname: null
            }
        },
        mounted(){
            if (!this.$store.getters.isLogin) {
                return this.$router.push({name: 'login'});
            }
            this.nickname = this.$store.getters.user.nickname;
            this.token = this.$store.getters.token;
        },
        methods: {
            save: function () {
                let route = '/user/save';
                let json = {
                    nickname: this.nickname,
                    token: this.token
                };
                api.post(route, json).then(function () {
                    alert('保存成功');
                }).catch(res => {
                    alert(res.message);
                });
            }
        }
    }
</script>