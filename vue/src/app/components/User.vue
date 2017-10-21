<template>
    <div id="user">
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
    export default {
        name: 'user',
        data () {
            return {}
        },
        mounted(){
            if (!this.$store.getters.isLogin) {
                return this.$router.push({name: 'login'});
            }
            //            this.username = this.$store.getters.user.username;
        }
    }
</script>