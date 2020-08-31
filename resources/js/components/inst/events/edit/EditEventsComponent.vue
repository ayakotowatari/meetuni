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
    
    <eventheader-component></eventheader-component>
     
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
import EditEventBasics from './EditEventBasicsComponent'
import EditEventSelect from './EditEventSelectComponent'
import EditEventFile from './EditEventFileComponent'
import EventHeader from '../../parts/EventHeaderComponent'

import { mapState } from 'vuex'

export default {
components: {
    EditEventBasics,
    EditEventSelect,
    EditEventFile,
    EventHeader
},
data: function(){
    return{
            id: this.$route.params.id,
            dialog: false,
        }
    console.log(id);
},
mounted(){
    this.$store.dispatch('fetchSingleEvent', {
          id: this.id
    });
},
created(){
   
},
methods: {
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
        'event',
    ])
}
}
</script>

<style>
.mb-24{
  margin-bottom: 18px;
}

</style>