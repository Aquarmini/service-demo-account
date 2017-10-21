<template>
    <div id="index">
        <div class="weui-flex">
            <div class="weui-flex__item">
                <div class="placeholder">
                    <div class="weui-cells">
                        <div class="weui-cell">
                            <div class="weui-cell__hd" style="position: relative;margin-right: 10px;">
                                <img src="../../assets/logo.png" style="width: 50px;display: block">
                                <span class="weui-badge" style="position: absolute;top: -.4em;right: -.4em;">8</span>
                            </div>
                            <div class="weui-cell__bd">
                                <p>联系人名称</p>
                                <p style="font-size: 13px;color: #888888;">摘要信息</p>
                            </div>
                        </div>
                        <div class="weui-cell weui-cell_access">
                            <div class="weui-cell__bd">
                                <span style="vertical-align: middle">单行列表</span>
                                <span class="weui-badge" style="margin-left: 5px;">8</span>
                            </div>
                            <div class="weui-cell__ft"></div>
                        </div>
                        <div class="weui-cell weui-cell_access">
                            <div class="weui-cell__bd">
                                <span style="vertical-align: middle">单行列表</span>
                                <span class="weui-badge" style="margin-left: 5px;">8</span>
                            </div>
                            <div class="weui-cell__ft">详细信息</div>
                        </div>
                        <div class="weui-cell weui-cell_access">
                            <div class="weui-cell__bd">
                                <span style="vertical-align: middle">单行列表</span>
                                <span class="weui-badge" style="margin-left: 5px;">New</span>
                            </div>
                            <div class="weui-cell__ft"></div>
                        </div>
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
        data () {
            return {
                msg: 'Welcome to Your Vue.js App'
            }
        },
        mounted(){
            if (!this.$store.getters.isLogin) {
                return this.$router.push({name: 'login'});
            }
            console.log(this.$store.getters);
        }
    }
</script>