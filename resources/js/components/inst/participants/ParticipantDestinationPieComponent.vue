<template>
    <v-card
        class="mx-auto"
        max-width="500"
    >
        <piechart-component
        v-if="loaded"
        :chartdata="chartdata" 
        :options="options" 
        :width="400" 
        :height="300"
        ></piechart-component>
    </v-card>
</template>

<script>
import PieChart from '../../chart/PieChartComponent'

export default {
    props: {
        id: String
    },
    components: {
        PieChart
    },
    data: () => ({
        loaded: false,
        chartdata: {},
        options: {
            title :{
                display: true,
                position: "top",
                text: "Desired Destinations",
                fontSize: 18,
                fontColor: "#262626"
            },
            legend : {
                display: true,
                position: "bottom"
            }
        }
    }),
    mounted(){
        this.fillChartData();
    },
    methods: {
        async fillChartData(){
             await axios
                .get('/inst/participant-destinations/' + this.id)
                .then(response => {
                    // console.log(response.data.destination);
                    // console.log(response.data.total);

                    let destination = response.data.destination;
                    let total = response.data.total;
                    // console.log(destination);
                    // console.log(total);
                    
                    this.chartdata = {
                        labels: destination,
                        datasets: [{
                            data: total,
                            backgroundColor: [
                                "#6A2B86",
                                "#F0E52F",
                                "#1ABEBE",
                                "#ED871D",
                                "#DF3291",
                                "#66266C",
                            ],
                            borderAlign: "inner"
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