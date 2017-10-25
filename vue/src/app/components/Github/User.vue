<template>
    <div id="github.user">
        <div class="weui-flex">
            <div class="weui-flex__item">
                <div class="placeholder">

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
            }
        },
        mounted() {
            if (!this.$store.getters.isLogin) {
                return this.$router.push({name: 'login'});
            }

            let that = this;
            let router = '/user/github/user';
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
        methods: {}
    }
</script>