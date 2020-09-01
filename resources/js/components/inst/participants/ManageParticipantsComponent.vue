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

   <participantslist-component v-bind:id="id"></participantslist-component>
  </v-container>
</template>

<script>
import moment from 'moment-timezone'
import EventHeader from '../parts/EventHeaderComponent'
import DashboardMenu from '../dashboard/DashboardMenuComponent'
import ParticipantsList from './ParticipantsListComponent'

export default {
components: {
    EventHeader,
    DashboardMenu,
    ParticipantsList,
},
data: function(){
    return{
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