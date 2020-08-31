<template>
<div>
    <v-row>
        <v-col col="12" sm="12" md="6">
            <v-card
                class="mt-4 mx-auto"
                max-width="480"
            >
                <v-sheet
                    class="v-sheet--offset mx-auto"
                    color="white"
                    elevation="12"
                    max-width="calc(100% - 32px)"
                >
                    <eventbookingchart-component></eventbookingchart-component>
                </v-sheet>
                <v-card-text class="pt-0">
                    <div class="title font-weight-light mb-2 mt-6">Student Registrations</div>
                    <div class="subheading font-weight-light grey--text">Last Campaign Performance</div>
                    <v-divider class="my-2"></v-divider>
                    <v-icon
                        class="mr-2"
                        small
                    >
                        mdi-clock
                    </v-icon>
                    <span class="caption grey--text font-weight-light">last registration 26 minutes ago</span>
                </v-card-text>
            </v-card>
        </v-col>
        <v-col col="12" sm="12" md="6">
            <v-card
                class="mt-4 mx-auto"
                max-width="480"
            >
                <v-sheet
                    class="v-sheet--offset mx-auto"
                    color="white"
                    elevation="12"
                    max-width="calc(100% - 32px)"
                >
                    <eventbookingchart-component :width="400" :height="300"></eventbookingchart-component>
                </v-sheet>
                <v-card-text class="pt-0">
                    <div class="title font-weight-light mb-2 mt-6">Latest Likes</div>
                    <div class="subheading font-weight-light grey--text">Last Campaign Performance</div>
                    <v-divider class="my-2"></v-divider>
                    <v-icon
                        class="mr-2"
                        small
                    >
                        mdi-clock
                    </v-icon>
                    <span class="caption grey--text font-weight-light">last registration 26 minutes ago</span>
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
</div>
</template>

<script>
import EventBookingChart from './EventBookingChartComponent'

export default {
    components: {
        EventBookingChart
    }

}
</script>

<style>
/* .chart{
    width: 300px;
    height: 200px;
} */
</style>