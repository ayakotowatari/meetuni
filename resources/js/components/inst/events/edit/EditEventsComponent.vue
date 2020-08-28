<template>
  <v-container>
    <v-row justify="center">
        <v-dialog v-model="dialog" persistent max-width="420">
        <v-card>
            <v-card-title class="headline">Your project has been published.</v-card-title>
            <v-card-text>Your dashboard is ready to help you manage the event.</v-card-text>
            <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="info darken-2" text @click="toDashboard(id)">Go to Dashboard</v-btn>
            <v-btn color="info darken-2" text @click="toMyEvents">Back to My Events</v-btn>
            </v-card-actions>
        </v-card>
        </v-dialog>
    </v-row>
    <v-row>
      <v-col>
        <h2 class="grey--text text--darken-4">{{ event.title }}</h2> 
        <div>{{ formattedDate(event.date, user.timezone) }}</div>
        <div>
          {{ formattedStartTime(event.start_utc, user.timezone) }} - 
          {{ formattedEndTime(event.end_utc, user.timezone) }}
        </div>
        <div>
          <span>Targets:</span>
          <span v-for="eventRegion in eventRegions" :key="eventRegion.region" class="ml-3">{{ eventRegion.region }}</span>
        </div>
        <div>
          <span>Levels:</span>
          <span v-for="eventLevel in eventLevels" :key="eventLevel.level" class="ml-3">{{ eventLevel.level }}</span>
        </div>
        <div>
          <span>Subjects:</span>
          <span v-for="eventSubject in eventSubjects" :key="eventSubject.subject" class="ml-3">{{ eventSubject.subject }}</span>
        </div>
      </v-col>
    </v-row>
    <v-row class="mb-10">
      <v-col>
        <div class="mb-24">
          <span>Status: </span>
          <v-chip :color="getColor(event.status)" class="ma-2">{{ event.status }}</v-chip>
        </div>
        <v-btn
          v-if="event.status === 'Draft'"
          color="error"
          outlined
          @click="publish(id)"
        >Publish</v-btn>
         <v-btn
          v-if="event.status === 'Ongoing'"
          color="primary"
          outlined
        >Unpublish</v-btn>
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
        class="mb-10"
      ></editeventbasics-component>

      <v-divider></v-divider>

      <editeventselect-component
        v-bind:id="id"
        v-bind:eventRegions="eventRegions"
        v-bind:eventLevels="eventLevels"
        v-bind:eventSubjects="eventSubjects"
        v-bind:regions="regions"
        v-bind:levels="levels"
        v-bind:subjects="subjects"
        class="my-10"
      ></editeventselect-component>

      <v-divider></v-divider>

      <editeventfile-component
        v-bind:id="id"
        v-bind:description="description"
        v-bind:files="files"
      ></editeventfile-component>
    </v-container>    
  </v-container>
</template>

<script>
// import EventHeader from './parts/EventHeaderComponent'
import moment from 'moment-timezone'
import EditEventBasics from './EditEventBasicsComponent'
import EditEventSelect from './EditEventSelectComponent'
import EditEventFile from './EditEventFileComponent'

export default {
components: {
    EditEventBasics,
    EditEventSelect,
    EditEventFile
},
props: {
    user: Object,
    regions: Array,
    levels: Array,
    subjects: Array
},

data: function(){
    return{
            id: this.$route.params.id,
            dialog: false,
            event: {},
            title: '',
            date: '',
            timezone: '',
            time: '',
            time2: '',
            description: '',
            files: '',
            eventRegions: [],
            eventLevels: [],
            eventSubjects: [],
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
                this.time2 = res.data.event.end_time;
                this.description = res.data.event.description;
                this.files = res.data.event.image;
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
    },
    getColor(status){
      if (status == 'Ongoing') return 'primary'
      else if (status == 'Draft') return 'error'
      else return 'info'
    },
    publish(id){
      axios
        .post('/inst/publish-event' + this.id)
        .then(res => {
          this.dialog = true
        })
    },
    toDashboard(id){
      this.$router.push({name: 'dashboard', params: {id: id}})
    },
    toMyEvents(){
            this.$router.push({ name: 'events'})
    }
}
}
</script>

<style>
.mb-24{
  margin-bottom: 18px;
}

</style>