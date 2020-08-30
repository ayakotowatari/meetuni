<template>
    <linechart-component 
        v-if="loaded"
        v-bind:data="data" 
        v-bind:options="options" 
        :width="400" 
        :height="300"
        ></linechart-component>
</template>

<script>
import LineChart from '../../chart/LineChartComponent'

export default {
    components: {
        LineChart
    },
    data: () => ({
        loaded: false,
        data: {
            datasets: [{
                data: [],   //グラフで使うデータ
                backgroundColor: '#ffffff'      //背景色
            }],
            labels: []    // X軸のラベル名
        },
        options: {
            responsive: false,    //グラフサイズの自動調整
            legend: {
                display: false   //凡例の非表示
            },
            title: {
                display: false,   //タイトルの表示
                fontSize: 18,    //フォントサイズ
                text: 'タイトル'   //グラフ名表示
            },
            scales: {
                yAxes: [{
                    display: true,        //Y軸の表示
                    scaleLabel: {
                        display: true,     //Y軸のラベル表示
                        labelString: 'Y',  //Y軸のラベル
                        fontSize: 18       //Y軸のラベルのフォントサイズ
                    },
                    ticks: {
                        min: 0,           //Y軸の最小値
                        max: 5,          //Y軸の最大値
                        fontSize: 18,     //Y軸のフォントサイズ
                        stepSize: 1      //Y軸の間隔
                    },
                }],
                xAxes: [{
                    display: true,        //X軸の表示
                    scaleLabel: {
                        display: true,     //X軸の表示
                        labelString: 'X',  //X軸のラベル
                        fontSize: 18       //X軸のラベルのフォントサイズ
                    },
                    ticks: {
                        fontSize: 18      //X軸のフォントサイズ
                    },
                }],
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 50,
                        bottom: 10
                    }
                }
        }
    }), 
    mounted(){
        this.fillChartData();
    },
    methods: {
        fillChartData(){
            axios
                .get('/inst/event-bookings/' + this.$route.params.id)
                .then(response => {
                    console.log(response.data.chartData);
                    // console.log(response.data.date);

                    // var jsonfile = {
                    // "jsonarray": [{
                    //     "name": "Joe",
                    //     "age": 12
                    // }, {
                    //     "name": "Tom",
                    //     "age": 14
                    // }]
                    // };

                    let chartData = response.data.chartData;

                    console.log(chartData[0].date);
                    console.log(chartData[0].total);

                    let data = new Array(chartData.length);
                    let labels = new Array(chartData.length);

                    for(let i = 0; i<chartData.length; i++){
                        data[i] = chartData[i].total;
                        labels[i] = chartData[i].date;
                        
                    };

                    console.log(data);

                    this.data.datasets.data = data;
                    this.data.labels = labels;

                })
                .catch(error => {
                console.error(error);
                })
                .finally(() => this.loaded = true)
        },
    },
}
</script>

<style>

</style>