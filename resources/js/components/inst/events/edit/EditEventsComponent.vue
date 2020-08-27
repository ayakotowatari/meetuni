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
          <span v-for="region in regions" :key="region.region" class="ml-3">{{ region.region }}</span>
        </div>
        <div class="text--primary">
          <span>Levels:</span>
          <span v-for="level in levels" :key="level.level" class="ml-3">{{ level.level }}</span>
        </div>
        <div class="text--primary">
          <span>Subjects:</span>
          <span v-for="subject in subjects" :key="subject.subject" class="ml-3">{{ subject.subject }}</span>
        </div>
      </v-col>
    </v-row>

    <h1 class="grey--text mb-6">Edit Events</h1>
    <v-container>
      <editeventbasics-component
        v-bind:id="id"
        v-bind:event="event"
        v-bind:title="title"
        v-bind:date="date"
        v-bind:timezone="timezone"
        v-bind:time="time"
        v-bind:time2="time2"
        v-bind:regions="regions"
        v-bind:levels="levels"
        v-bind:subjects="subjects"
      ></editeventbasics-component>
      <v-divider></v-divider>
    </v-container>    
  </v-container>
</template>

<script>
// import EventHeader from './parts/EventHeaderComponent'
import moment from 'moment-timezone'
import EditEventBasices from './EditEventBasicsComponent'

export default {
components: {
    // EventHeader,
},
props: {
    user: Object,
},

data: function(){
    return{
            id: this.$route.params.id,
            event: {},
            title: '',
            date: '',
            timezone: '',
            time: '',
            time2: '',
            regions: [],
            levels: [],
            subjects: [],
        }
    console.log(id);
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
                this.title = res.data.event.title;
                this.timezone = res.data.event.timezone;
                this.date = res.data.event.date;
                this.time = res.data.event.start_time;
                this.time2 = res.data.event.end_time
            })
    },
    fetchEventRegions: function(id) {
        console.log(id);
        axios.get("/inst/fetch-event-regions/" + this.id).then(res => {
            this.regions = res.data.regions;
        })
    },
    fetchEventLevels: function(id) {
        console.log(id);
        axios.get("/inst/fetch-event-levels/" + this.id).then(res => {
            this.levels = res.data.levels;
        })
    },
    fetchEventSubjects: function(id) {
        console.log(id);
        axios.get("/inst/fetch-event-subjects/" + this.id).then(res => {
            this.subjects = res.data.subjects;
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
}
}
</script>

<style>

</style>