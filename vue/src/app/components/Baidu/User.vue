<template>
    <div id="baidu.user">
        <div class="weui-flex">
            <div class="weui-flex__item">
                <div class="placeholder">
                    <div class="weui-cells">
                        <router-link to="/baidu/edit" class="weui-cell weui-cell_access">
                            <div class="weui-cell__bd">
                                <span style="vertical-align: middle">{{nickname}}</span>
                            </div>
                            <div class="weui-cell__ft">新增贴吧账号</div>
                        </router-link>
                    </div>
                    <div class="weui-panel">
                        <div class="weui-panel__hd">
                            我的百度贴吧账号
                        </div>
                        <div class="weui-panel__bd">
                            <div class="weui-media-box weui-media-box_text" v-for="item in items">
                                <h4 class="weui-media-box__title">标题一</h4>
                                <p class="weui-media-box__desc">由各种物质组成的巨型球状天体，叫做星球。星球有一定的形状，有自己的运行轨道。</p>
                                <ul class="weui-media-box__info">
                                    <li class="weui-media-box__info__meta">文字来源</li>
                                    <li class="weui-media-box__info__meta">时间</li>
                                    <li class="weui-media-box__info__meta weui-media-box__info__meta_extra">其它信息</li>
                                </ul>
                            </div>
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
        name: 'baidu.user',
        data () {
            return {
                nickname: null,
                items: [1, 2, 3]
            }
        },
        mounted(){
            if (!this.$store.getters.isLogin) {
                return this.$router.push({name: 'login'});
            }
            this.nickname = this.$store.getters.user.nickname;

            console.log(this.nickname);
        }
    }
</script>