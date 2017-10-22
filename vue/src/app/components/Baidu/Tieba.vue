<template>
    <div id="tieba">
        <div class="weui-flex">
            <div class="weui-flex__item">
                <div class="placeholder">
                    <div class="weui-cells">
                        <div class="weui-cell" v-for="item in items">
                            <div class="weui-cell__bd">
                                <span style="vertical-align: middle">单行列表</span>
                                <span class="weui-badge" style="margin-left: 5px;">8</span>
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
        name: 'tieba',
        data () {
            return {
                items: [1, 2, 3]
            }
        },
        mounted(){
            if (!this.$store.getters.isLogin) {
                return this.$router.push({name: 'login'});
            }
        }
    }
</script>