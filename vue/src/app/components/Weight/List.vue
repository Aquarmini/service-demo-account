<template>
    <div id="weight.list">
        <div class="weui-flex">
            <div class="weui-flex__item">
                <div class="placeholder">
                    <div class="weui-cells">
                        <router-link to="/weight/edit" class="weui-cell weui-cell_access">
                            <div class="weui-cell__bd">
                                <span style="vertical-align: middle">我的体重列表</span>
                            </div>
                            <div class="weui-cell__ft">新增体重</div>
                        </router-link>
                    </div>
                    <div class="weui-tab" id="tab">
                        <div class="weui-navbar">
                            <div class="weui-navbar__item">体重列表</div>
                            <div class="weui-navbar__item">曲线图</div>
                        </div>
                        <div class="weui-tab__panel">
                            <div class="weui-tab__content">
                                <div class="weui-panel weui-panel_access">
                                    <div class="weui-panel__bd">
                                        <div class="weui-media-box weui-media-box_text" v-for="(item,index) in items">
                                            <h4 class="weui-media-box__title">{{item.weight}} kg</h4>
                                            <ul class="weui-media-box__info">
                                                <li class="weui-media-box__info__meta">时间</li>
                                                <li class="weui-media-box__info__meta weui-media-box__info__meta_extra">
                                                    {{item.date}}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="weui-tab__content">
                                <div :style="{height:height+'px',width:width+'px'}" ref="echart">
                                </div>
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
    import api from '../../../common/api'
    import weui from 'weui.js'
    import echarts from 'echarts'

    export default {
        name: 'weight.list',
        data() {
            return {
                items: [],
                width: document.body.clientWidth,
                height: 400,
            }
        },
        mounted() {
            if (!this.$store.getters.isLogin) {
                return this.$router.push({name: 'login'});
            }
            this.init();
            this.list();
        },
        methods: {
            init: function () {
                let that = this;
                console.log(document.body.clientWidth);
                weui.tab('#tab', {
                    defaultIndex: 0,
                    onChange: function (index) {
                        console.log(index);
                    }
                });
            },
            list: function () {
                let that = this;
                let router = '/user/weight/index';
                let token = this.$store.getters.token;
                let json = {
                    token: token
                };
                api.post(router, json).then(res => {
                    that.items = res;
                    console.log(res);
                    that.echart();
                }).catch(res => {
                    weui.alert(res.message);
                });
            },
            echart: function () {
                let that = this;
                let chart = echarts.init(this.$refs.echart);
                let date = [];
                let value = [];

                for (let i = 0; i < that.items.length; i++) {
                    date[i] = that.items[i].date;
                    value[i] = that.items[i].weight;
                }
                chart.setOption({
                    color: ['#3398DB'],
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: { // 坐标轴指示器，坐标轴触发有效
                            type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                        }
                    },
                    grid: {
                        left: '3%',
                        right: '4%',
                        bottom: '3%',
                        containLabel: true
                    },
                    xAxis: [{
                        type: 'category',
                        data: date,
                        axisTick: {
                            alignWithLabel: true
                        }
                    }],
                    yAxis: [{
                        type: 'value'
                    }],
                    series: [{
                        name: '体重',
                        type: 'bar',
                        barWidth: '60%',
                        data: value
                    }]
                })
            },
        }
    }
</script>