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
                    <div class="weui-cell" id="uploader">
                        <div class="weui-cell__bd">
                            <div class="weui-uploader">
                                <div class="weui-uploader__hd">
                                    <p class="weui-uploader__title">头像上传</p>
                                </div>
                                <div class="weui-uploader__bd">
                                    <ul class="weui-uploader__files" ref="uploaderFiles" id="uploaderFiles">
                                        <li class="weui-uploader__file"
                                            v-bind:style="{'background-image':'url('+avatar+')'}"></li>
                                    </ul>
                                    <div class="weui-uploader__input-box">
                                        <input id="uploaderInput" class="weui-uploader__input" type="file"
                                               accept="image/*" capture="camera" multiple=""/>
                                    </div>
                                </div>
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
    import weui from 'weui.js'

    export default {
        name: 'user',
        data () {
            return {
                nickname: null,
            }
        },
        mounted(){
            if (!this.$store.getters.isLogin) {
                return this.$router.push({name: 'login'});
            }
            this.nickname = this.$store.getters.user.nickname;
            this.token = this.$store.getters.token;
            this.avatar = this.$store.getters.user.avatar;
            this.upload();
        },
        methods: {
            save: function () {
                let that = this;
                let route = '/user/save';
                let json = {
                    nickname: this.nickname,
                    avatar: this.avatar,
                    token: this.token
                };
                console.log(json);

                api.post(route, json).then(function () {
                    let user = that.$store.getters.user;
                    user.nickname = that.nickname;
                    let token = that.$store.getters.token;
                    that.$store.dispatch('setUserInfo', {token, user}).then(function () {
                        weui.alert('保存成功');
                    });
                }).catch(res => {
                    weui.alert(res.message);
                });
            },
            upload: function () {
                let that = this;
                weui.uploader('#uploader', {
                    url: '/common/image/upload',
                    auto: true,
                    type: 'file',
                    fileVal: 'fileVal',
                    compress: {
                        width: 1600,
                        height: 1600,
                        quality: .8
                    },
                    onBeforeQueued: function (files) {
                        if (["image/jpg", "image/jpeg", "image/png", "image/gif"].indexOf(this.type) < 0) {
                            weui.alert('请上传图片');
                            return false; // 阻止文件添加
                        }
                        if (this.size > 10 * 1024 * 1024) {
                            weui.alert('请上传不超过10M的图片');
                            return false;
                        }
                        if (files.length > 1) { // 防止一下子选择过多文件
                            weui.alert('最多只能上传1张图片，请重新选择');
                            return false;
                        }

                        // 清空列表
                        that.$refs.uploaderFiles.innerHTML = null;
                        // return true; // 阻止默认行为，不插入预览图的框架
                    },
                    onSuccess: function (ret) {
                        if (ret.code !== 0) {
                            // 上传失败
                            weui.alert(ret.message);
                        }
                        that.avatar = ret.data.image;
                        console.log(ret.data);
                        // return true; // 阻止默认行为，不使用默认的成功态
                    },
                    onError: function (err) {
                        console.log(this, err);
                        weui.alert(err.message);
                    }
                });
            }
        }
    }
</script>