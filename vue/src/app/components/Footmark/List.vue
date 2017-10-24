<template>
    <div id="footmark.list">
        <div class="weui-flex">
            <div class="weui-flex__item">
                <div class="placeholder">
                    <div class="weui-cells">
                        <router-link to="/footmark/edit" class="weui-cell weui-cell_access">
                            <div class="weui-cell__bd">
                                <span style="vertical-align: middle">{{nickname}}</span>
                            </div>
                            <div class="weui-cell__ft">新增足迹</div>
                        </router-link>
                    </div>
                    <div class="weui-panel weui-panel_access">
                        <div class="weui-panel__hd">我的足迹</div>
                        <div class="weui-panel__bd">
                            <a class="weui-media-box weui-media-box_appmsg" v-for="(item,index) in items">
                                <div class="weui-media-box__hd">
                                    <img class="weui-media-box__thumb" src="" alt="">
                                </div>
                                <div class="weui-media-box__bd">
                                    <h4 class="weui-media-box__title">标题一</h4>
                                    <p class="weui-media-box__desc">由各种物质组成的巨型球状天体，叫做星球。星球有一定的形状，有自己的运行轨道。</p>
                                </div>
                            </a>
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
        name: 'footmark.list',
        data() {
            return {
                items: []
            }
        },
        mounted() {
            if (!this.$store.getters.isLogin) {
                return this.$router.push({name: 'login'});
            }

        }
    }
</script>