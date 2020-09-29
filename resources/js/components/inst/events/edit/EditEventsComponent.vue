<template>
  <div>
      <v-container v-if="user.id === event.user_id">
        <v-row justify="center">
            <v-dialog v-model="dialog" persistent max-width="420">
            <v-card v-if="isPublished == true">
                <v-card-title class="headline">Your project has been published.</v-card-title>
                <v-card-text>Your dashboard is ready to help you manage the event.</v-card-text>
                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="info darken-2" text @click="toDashboard">Go to Dashboard</v-btn>
                <v-btn color="info darken-2" text @click="toMyEvents">Go to My Events</v-btn>
                </v-card-actions>
            </v-card>
            <v-card v-if="isPublished == false">
                <v-card-title class="headline">Your project has been unpublished.</v-card-title>
                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="info darken-2" text @click="close">Close</v-btn>
                <v-btn color="info darken-2" text @click="toMyEvents">Leave to My Events</v-btn>
                </v-card-actions>
            </v-card>
            </v-dialog>
        </v-row>
        
        <eventheader-component></eventheader-component>
        
        <v-row class="mb-10">
            <v-col>
                <div class="mb-4">
                    <span>Status: </span>
                    <v-chip :color="getColor(event.status)" class="ma-2">{{ event.status }}</v-chip>
                </div>
                <v-btn
                    v-if="
                      event.status == 'Draft' && 
                      event.description !== null && 
                      event.files !== null &&
                      eventRegions !== null &&
                      eventLevels !== null &&
                      eventSubjects != null
                    "
                    color="error"
                    outlined
                    @click="publish"
                >Publish</v-btn>
                <v-btn
                    v-if="event.status == 'Ongoing'"
                    color="primary"
                    outlined
                    @click="unpublish"
                >Unpublish</v-btn>
                <h3 
                    class="grey--text text--darken-2"
                    v-if="
                      event.description == null || 
                      event.files == null ||
                      eventRegions == null ||
                      eventLevels == null ||
                      eventSubjects == null
                    "
                >Some information needs to be filled before publishing this event.</h3>
            </v-col>
        </v-row>

        <h1 class="grey--text mb-6">Edit Events</h1>
        <v-container>
          <editeventbasics-component
            v-bind:id="id"
            v-bind:event="event"
            class="mb-10"
          ></editeventbasics-component>

          <v-divider></v-divider>

          <editeventselect-component
            v-bind:id="id"
            class="my-10"
            v-bind:eventRegions="eventRegions"
            v-bind:eventLevels="eventLevels"
            v-bind:eventSubjects="eventSubjects"
          ></editeventselect-component>

          <v-divider></v-divider>

          <editeventfile-component
            v-bind:id="id"
            v-bind:event="event"
          ></editeventfile-component>
        </v-container>    
      </v-container>
      <v-container v-if="user.id !== event.user_id">
          <v-row justify="center">
              <v-col cols="12" xs="12" md="4">
                  <h2 class="grey--text mt-8">You are not authorized to edit this event.</h2> 
              </v-col>
          </v-row>
      </v-container>
  </div>
</template>

<script>
// import EventHeader from './parts/EventHeaderComponent'
import EditEventBasics from './EditEventBasicsComponent'
import EditEventSelect from './EditEventSelectComponent'
import EditEventFile from './EditEventFileComponent'
import EventHeader from '../../parts/EventHeaderComponent'

import { mapState, mapActions, mapMutations } from 'vuex'

export default {
components: {
    EditEventBasics,
    EditEventSelect,
    EditEventFile,
    EventHeader
},
props: {
    user: Object,
},
data: function(){
    return{
            id: this.$route.params.id,
            // dialog: false,
            // isPublished: false,
            // isUnpublished: false,
        }
    console.log(id);
},
mounted(){
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
computed: {
    ...mapState ([
        'event',
        'dialog',
        'isPublished',
        'isUnpublished',
        'eventRegions',
        'eventLevels',
        'eventSubjects'
    ])
},
methods: {
    getColor(status){
      if (status == 'Ongoing') return 'primary'
      else if (status == 'Draft') return 'error'
      else return 'info'
    },
    ...mapMutations({
      close: 'closeDialog'
    }),
    ...mapActions([
      'publishEvent',
      'unpublishEvent',
      'toDashboardPage',
      'toMyEventsPage'
    ]),
    publish(){
      this.publishEvent({
        id: this.id
      })
    },
    unpublish(){
      this.unpublishEvent({
        id: this.id
      });
    },
    // toDashboard(id){
    //   this.$router.push({name: 'dashboard', params: {id: id}});
    //   this.dialog = false;
    // },
    toDashboard(){
      this.toDashboardPage({
        id: this.id
      })
    },
    // toMyEvents(){
    //   this.$router.push({ name: 'events'})
    //   this.dialog = false;
    // },
    toMyEvents(){
      this.toMyEventsPage();
    },
},
}
</script>

<style>
.mb-24{
  margin-bottom: 18px;
}

</style>