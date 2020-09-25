<template>
  <v-container>
    <v-row class="mb-8">
        <v-col col="12" sm="12" md="8">
            <eventheader-component></eventheader-component>
        </v-col>
    </v-row>
    <v-row class="mb-8">
        <h1 class="grey--text mb-6">Dashboard</h1>
        <v-spacer></v-spacer>
        <v-col col="12" sm="12" md="2">
            <dashboardmenu-component v-bind:id="id"></dashboardmenu-component>
        </v-col>
    </v-row>
    <dashboardsummary-component></dashboardsummary-component>
    <dashboardchart-component></dashboardchart-component>
    <v-btn depressed outlined color="grey darken-2" class="mt-8" @click="print()">print</v-btn>
  </v-container>
</template>

<script>
import DashboardMenu from './DashboardMenuComponent'
import DashboardSummary from './DashboardSummaryComponent'
import DashboardChart from './DashboardChartComponent'
import EventHeader from '../parts/EventHeaderComponent'

import { mapState } from 'vuex'

export default {
components: {
    // EventHeader,
    DashboardSummary,
    DashboardChart,
    DashboardMenu,
    EventHeader
},

data: function(){
    return{
            id: this.$route.params.id,
        }
    console.log(id);
},
mounted(){
   
},
created(){
    
},
methods: {
    print(){
        window.print();
    }
},
computed: {
   
}
}
</script>

<style>

</style>