<template>
    <div>
        <v-container v-if="eventOwner.user_id === user.id">
            <v-row class="mb-8">
                <v-col cols="12" sm="12" md="8">
                    <eventheader-component></eventheader-component>
                </v-col>
            </v-row>
            <v-row class="mb-8">
                <h1 class="grey--text mb-6">Dashboard</h1>
                <v-spacer></v-spacer>
                <v-col cols="12" sm="12" md="2">
                    <dashboardmenu-component v-bind:id="id"></dashboardmenu-component>
                </v-col>
            </v-row>
            <dashboardsummary-component
                v-bind:id="id"
            ></dashboardsummary-component>
            <dashboardchart-component></dashboardchart-component>
            <v-btn depressed outlined color="grey darken-2" class="mt-8" @click="print()">print</v-btn>
        </v-container>
        <v-container v-if="eventOwner.user_id !== user_id">
          <v-row justify="center">
              <v-col cols="12" xs="12" md="4">
                  <h2 class="grey--text mt-8">You are not authorized to view this Dashboard.</h2> 
              </v-col>
          </v-row>
      </v-container>
    </div>
</template>

<script>
import { mapState } from 'vuex'

import DashboardMenu from './DashboardMenuComponent'
import DashboardSummary from './DashboardSummaryComponent'
import DashboardChart from './DashboardChartComponent'
import EventHeader from '../parts/EventHeaderComponent'


export default {
components: {
    // EventHeader,
    DashboardSummary,
    DashboardChart,
    DashboardMenu,
    EventHeader
},
props: {
    user: Object,
},
data: function(){
    return{
            id: this.$route.params.id,
        }
    // console.log(id);
},
mounted(){
   this.$store.dispatch('fetchEventOwner', {
       id: this.id
   });
},
computed: {
    ...mapState([
        'eventOwner',
    ])
},
methods: {
    print(){
        window.print();
    }
},
}
</script>

<style>

</style>