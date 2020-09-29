<template>
<div>
    <linechart-component 
        v-if="loaded"
        :chartdata="chartdata" 
        :options="options" 
        :width="400" 
        :height="300"
    ></linechart-component>
</div>
</template>

<script>
import LineChart from '../../chart/LineChartComponent'

export default {
    name: 'EventBookingChartComponent',
    components: {
        LineChart
    },
    data: () => ({
        loaded: false,
        chartdata: {},
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
                        labelString: '',  //Y軸のラベル
                        fontFamily: 'Roboto',
                        fontSize: 18       //Y軸のラベルのフォントサイズ
                    },
                    ticks: {
                        min: 0,           //Y軸の最小値
                        max: 5,          //Y軸の最大値
                        fontFamily: 'Roboto',
                        fontSize: 18,     //Y軸のフォントサイズ
                        stepSize: 1      //Y軸の間隔
                    },
                }],
                xAxes: [{
                    display: true,        //X軸の表示
                    scaleLabel: {
                        display: true,     //X軸の表示
                        labelString: '',  //X軸のラベル
                        fontSize: 18       //X軸のラベルのフォントサイズ
                    },
                    ticks: {
                        fontFamily: "Roboto",
                        fontSize: 14      //X軸のフォントサイズ
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
        this.fillChartDataForBooking();
    },
    methods: {
        async fillChartDataForBooking(){
             await axios
                .get('/inst/event-bookings/' + this.$route.params.id)
                .then(response => {
                    // console.log(response.data.chartDataForBooking);

                    let chartData = response.data.chartDataForBooking;

                    // console.log(chartData[0].date);
                    // console.log(chartData[0].total);

                    let bookingdata = new Array(chartData.length);
                    let labels = new Array(chartData.length);

                    for(let i = 0; i<chartData.length; i++){
                        bookingdata[i] = chartData[i].total;
                        labels[i] = chartData[i].date;
                    };

                    // console.log(bookingdata);
                    
                    this.chartdata = {
                        labels: labels,
                        datasets: [{
                            label: '',
                            data: bookingdata,
                            backgroundColor: '#323EDD',
                            borderColor: '#323EDD',
                            borderWidth: 2,
                            lineTension: 0,
                            fill: false,
                        }]
                    }
                    // this.loaded = true
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