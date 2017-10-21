<template>
    <div id="index">
        <img src="../../assets/logo.png">
        <div>{{msg}}</div>
        <a href="javascript:;" class="weui-btn weui-btn_primary">绿色按钮</a>
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