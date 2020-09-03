<template>
    <v-card
        class="mx-auto"
        max-width="800"
    >
        <barchart-component
        v-if="loaded"
        :chartdata="chartdata" 
        :options="options" 
        :width="400" 
        :height="400"
        ></barchart-component>
    </v-card>
</template>

<script>
import BarChart from '../../chart/BarChartComponent'

export default {
    props: {
        id: String
    },
    components: {
        BarChart
    },
    data: () => ({
        loaded: false,
        chartdata: {},
        options: {
            title: {
            display: false,
            position: "top",
            text: "Subject areas of interest",
            fontFamily: 'Roboto',
            fontSize: 18,
            fontColor: "#262626"
            },
            scales: {
                xAxes : [{
                    ticks: {
                        min: 0,
                        fontFamily: 'Roboto',
                    },
                    barPercentage: 0.8
                }]
            },
            legend: {
                display: false
            }
        }
    }),
    mounted(){
        this.fillChartData();
    },
    methods: {
        async fillChartData(){
             await axios
                .get('/inst/participant-subjects/' + this.id)
                .then(response => {
                    let subject = response.data.subject;
                    let total = response.data.total;
                    
                    this.chartdata = {
                        labels: subject,
                        datasets: [{
                            data: total,
                            backgroundColor: "#25DD76",
                            borderColor: "#25DD76",
                            borderWidth: 1,
                        }]
                    }
                    this.loaded = true
                    // this.$emit('isBooked');
                })
                .catch(error => {
                console.error(error);
                })
                // .finally(() => this.loaded = true)
        },
    }
}
</script>

<style>

</style>