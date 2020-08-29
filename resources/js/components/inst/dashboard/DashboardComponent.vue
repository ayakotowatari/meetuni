<template>
  <v-container>
    <v-row class="mb-8">
      <v-col>
        <div>{{ formattedDate(event.date, user.timezone) }}</div>
        <div>
          {{ formattedStartTime(event.start_utc, user.timezone) }} - 
          {{ formattedEndTime(event.end_utc, user.timezone) }}
        </div>
        <h2 class="grey--text text--darken-4">{{ event.title }}</h2> 
       
        <div class="text--primary">
          <span>Targets:</span>
          <span v-for="eventRegion in eventRegions" :key="eventRegion.region" class="ml-3">{{ eventRegion.region }}</span>
        </div>
        <div class="text--primary">
          <span>Levels:</span>
          <span v-for="eventLevel in eventLevels" :key="eventLevel.level" class="ml-3">{{ eventLevel.level }}</span>
        </div>
        <div class="text--primary">
          <span>Subjects:</span>
          <span v-for="eventSubject in eventSubjects" :key="eventSubject.subject" class="ml-3">{{ eventSubject.subject }}</span>
        </div>
      </v-col>
        <v-spacer></v-spacer>   
        <v-col col="12" sm="2" md="2" offset-md-4>
            <dashboardmenu-component v-bind:id="id"></dashboardmenu-component>
        </v-col>    
    </v-row>

    <h1 class="grey--text mb-6">Dashboard</h1>
    <dashboardsummary-component></dashboardsummary-component>
    <dashboardchart-component></dashboardchart-component>
  </v-container>
</template>

<script>
// import EventHeader from './parts/EventHeaderComponent'
import moment from 'moment-timezone'
import DashboardMenu from './DashboardMenuComponent'
import DashboardSummary from './DashboardSummaryComponent'
import DashboardChart from './DashboardChartComponent'

import { mapState } from 'vuex'

export default {
components: {
    // EventHeader,
    DashboardSummary,
    DashboardChart,
    DashboardMenu
},

data: function(){
    return{
            id: this.$route.params.id,
            event: {},
            eventRegions: {},
            eventLevels: {},
            eventSubjects: {},
        }
    console.log(id);
},
mounted(){
    this.$store.dispatch('fetchUser');
},
created(){
     this.fetchSingleEvent();
     this.fetchEventRegions();
     this.fetchEventLevels();
     this.fetchEventSubjects();
},
methods: {
    fetchSingleEvent: function(id) {
            console.log(id);
            axios.get("/inst/fetch-single-event/" + this.id).then(res => {
                this.event = res.data.event;
                console.log(event);
            })
    },
    fetchEventRegions: function(id) {
        console.log(id);
        axios.get("/inst/fetch-event-regions/" + this.id).then(res => {
            this.eventRegions = res.data.eventRegions;
        })
    },
    fetchEventLevels: function(id) {
        console.log(id);
        axios.get("/inst/fetch-event-levels/" + this.id).then(res => {
            this.eventLevels = res.data.eventLevels;
        })
    },
    fetchEventSubjects: function(id) {
        console.log(id);
        axios.get("/inst/fetch-event-subjects/" + this.id).then(res => {
            this.eventSubjects = res.data.eventSubjects;
        })
    },
    formattedDate(value, timezone){
        return moment.utc(value).local().tz(timezone).format("ddd, MMM Do YYYY")
    },
    formattedStartTime(value, timezone){
        return moment.utc(value).local().tz(timezone).format("h:mm a")
    },
    formattedEndTime(value, timezone){
        return moment.utc(value).local().tz(timezone).format("h:mm a ([GMT] Z)")
    }
},
computed: {
    ...mapState ([
        'user'
    ])
}
}
</script>

<style>

</style>