<template>
  <v-container>
     <v-row class="mb-8">
        <v-col col="12" sm="12" md="8">
            <eventheader-component></eventheader-component>
        </v-col>
    </v-row>
    <v-row class="mb-8">
        <h1 class="grey--text mb-6">Manage Participants</h1>
        <v-spacer></v-spacer>
        <v-col col="12" sm="12" md="2">
            <dashboardmenu-component v-bind:id="id"></dashboardmenu-component>
        </v-col>
    </v-row>
    <v-row justify="center" class="mb-6">
        <v-col cols="12" sm="12" md="12">
            <h2 class="grey--text text--darken-1">Participants List</h2>
        </v-col>
    </v-row>
    <div class="mb-12">
        <participantslist-component v-bind:id="id"></participantslist-component>
    </div>
    <v-row v-if="isBooked">
        <v-col col="12" sm="12" md="6" class="mb-12">
            <participantcountrypie-component v-bind:id="id"></participantcountrypie-component>
        </v-col>
    </v-row>
  </v-container>
</template>

<script>
import moment from 'moment-timezone'
import EventHeader from '../parts/EventHeaderComponent'
import DashboardMenu from '../dashboard/DashboardMenuComponent'
import ParticipantsList from './ParticipantsListComponent'
import ParticipantCountryPie from './ParticipantCountryPieComponent'

export default {
components: {
    EventHeader,
    DashboardMenu,
    ParticipantsList,
    ParticipantCountryPie
},
data: function(){
    return{
            isBooked: false,
            id: this.$route.params.id,
            selected: [],
            headers: [
            {
                text: 'Last Name',
                align: 'start',
                sortable: false,
                value: 'last_name',
            },
            { text: 'First Name', value: 'first_name' },
            { text: 'E-mail', value: 'email' },
            { text: 'Country', value: 'country' },
            { text: 'Booked At', value: 'created_at' },
            { text: 'Actions', value: 'actions' }
            ],
            allerror: []
        }

},
mounted(){
    // this.$store.dispatch('fetchEventParticipants', {
    //     id: this.id
    // })
    // this.fetchEventParticipants();
},
created(){

},
methods: {
    // fetchEventParticipants: function(){
    //         axios 
    //             .get("/inst/event-participants" + this.id)
    //             .then(res => {
    //                 this.participants = res.data.participants;
    //                 console.log(res.data.participants)
    //             })
    //             .catch(error => 
    //                 this.allerror = error.response.data.errors
    //             )
    //     },
    
},
computed: {
    // ...mapState ([
    //     'participants'
    // ])
}

}
</script>

<style>

</style>