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
        class="mb-10"
      ></editeventbasics-component>

      <v-divider></v-divider>

      <editeventselect-component
        v-bind:id="id"
        class="my-10"
      ></editeventselect-component>

      <v-divider></v-divider>

      <editeventfile-component
        v-bind:id="id"
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

import { mapState } from 'vuex'

export default {
components: {
    EditEventBasics,
    EditEventSelect,
    EditEventFile
},
data: function(){
    return{
            id: this.$route.params.id,
            dialog: false,
        }
    console.log(id);
},
mounted(){
    this.$store.dispatch('fetchUser');
    this.$store.dispatch('fetchSingleEvent', {
          id: this.id
    });
    this.$store.dispatch('fetchEventRegions', {
          id: this.id
    });
    this.$store.dispatch('fetchEventLevels', {
          id: this.id
    });
    this.$store.dispatch('fetchEventSubjects', {
          id: this.id
    });
},
created(){
   
},
methods: {
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
},
computed: {
    ...mapState ([
        'user',
        'event',
        'eventRegions',
        'eventLevels',
        'eventSubjects'
    ])
}
}
</script>

<style>
.mb-24{
  margin-bottom: 18px;
}

</style>