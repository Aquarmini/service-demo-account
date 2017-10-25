<template>
    <div id="footmark.edit">
        <div class="weui-flex">
            <div class="weui-flex__item">
                <div class="placeholder">
                    <div style="height:2em"></div>
                    <div class="weui-cells__title">新增授权</div>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell">
                            <div class="weui-cell__hd">
                                <label class="weui-label">名字</label>
                            </div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" type="text" placeholder="名字" v-model="name">
                            </div>
                        </div>
                        <div class="weui-cell weui-cell_select weui-cell_select-after">
                            <div class="weui-cell__hd">
                                <label for="" class="weui-label">类型</label>
                            </div>
                            <div class="weui-cell__bd">
                                <select class="weui-select" v-model="type">
                                    <option value="0">邮件</option>
                                    <option value="1">手机号</option>
                                    <option value="2">Github</option>
                                </select>
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd">
                                <label class="weui-label">数据</label>
                            </div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" type="text" placeholder="数据" v-model="code">
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
    import VueAMap from 'vue-amap'

    export default {
        name: 'footmark.edit',
        data() {
            let that = this;
            return {
                name: null,
                type: null,
                code: null,
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
                let router = '/user/oauth/save';
                let token = this.$store.getters.token;
                let json = {
                    name: this.name,
                    type: this.type,
                    code: this.code,
                    token: token
                };
                console.log(json);
                api.post(router, json).then(res => {
                    that.$router.back();
                }).catch(res => {
                    weui.alert(res.message);
                });
            }
        }
    }
</script>