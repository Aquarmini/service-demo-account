<template>
    <div id="map" style="height: 100%">
        <el-amap :vid="'demo'"></el-amap>
    </div>
</template>


<script>
    import Vue from 'vue'

    export default {
        name: 'map',
        data () {
            return {}
        },
        mounted(){
            if (!this.$store.getters.isLogin) {
                return this.$router.push({name: 'login'});
            }
        }
    }
</script>