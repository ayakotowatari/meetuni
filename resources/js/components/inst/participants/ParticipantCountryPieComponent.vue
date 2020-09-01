<template>
    <div>
        <v-row justify="center" class="mb-6">
            <v-col cols="12" sm="12" md="12">
                <h2 class="grey--text text--darken-1">Participant Statistics</h2>
            </v-col>
        </v-row>
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
    </div>
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
                text: "Country of origins",
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
                .get('/inst/participant-countries/' + this.id)
                .then(response => {
                    // console.log(response.data.country);
                    // console.log(response.data.total);

                    let country = response.data.country;
                    let total = response.data.total;
                    console.log(country);
                    console.log(total);
                    
                    this.chartdata = {
                        labels: country,
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