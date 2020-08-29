
<script>
import { Line } from 'vue-chartjs'

export default {
    extends: Line,
    data: () => ({
        data: {
            labels: [
                '7/1',
                '7/2',
                '7/3',
                '7/4',
                '7/5',
                '7/6',
                '7/7',

            ],    // X軸のラベル名
            datasets: [{
                data: [18, 20, 30, 20, 10, 20, 30],    //グラフで使うデータ
                backgroundColor: '#ffffff'      //背景色
            }]
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
                        max: 60,          //Y軸の最大値
                        fontSize: 18,     //Y軸のフォントサイズ
                        stepSize: 20       //Y軸の間隔
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
        this.renderChart(this.data, this.options)
    },
}
</script>

<style>

</style>