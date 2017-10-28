<template>
    <div id="weight.edit">
        <div class="weui-flex">
            <div class="weui-flex__item">
                <div class="placeholder">
                    <div style="height:2em"></div>
                    <div class="weui-cells__title">新增体重</div>
                    <div class="weui-cells weui-cells_form">
                        <div class="weui-cell">
                            <div class="weui-cell__hd">
                                <label class="weui-label">体重</label>
                            </div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" type="number" placeholder="体重" v-model="weight">
                            </div>
                        </div>
                        <div class="weui-cell">
                            <div class="weui-cell__hd">
                                <label for="" class="weui-label">日期</label>
                            </div>
                            <div class="weui-cell__bd">
                                <input class="weui-input" type="text" v-on:click="datePicker" placeholder="日期"
                                       readonly v-model="date">
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
        name: 'weight.edit',
        data() {
            let that = this;
            return {
                weight: null,
                date: null,
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
                let router = '/user/weight/add';
                let token = this.$store.getters.token;
                let json = {
                    weight: this.weight,
                    date: this.date,
                    token: token
                };
                console.log(json);
                api.post(router, json).then(res => {
                    that.$router.back();
                }).catch(res => {
                    weui.alert(res.message);
                });
            },
            datePicker: function () {
                let that = this;
                var date = new Date();

                weui.datePicker({
                    start: 2017,
                    end: 2020,
                    defaultValue: [date.getFullYear(), date.getMonth() + 1, date.getDate()],
                    onConfirm: function (result) {
                        let year = result[0].value;
                        let month = result[1].value;
                        let day = result[2].value;
                        that.date = year + '-' + month + '-' + day;
                    },
                    id: 'datePicker'
                });
            }
        }
    }
</script>