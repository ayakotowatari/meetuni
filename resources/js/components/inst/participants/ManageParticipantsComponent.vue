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
    ParticipantsList
},
data: function(){
    return{
            id: this.$route.params.id,
            
        }
        console.log(id);
},
created(){

},
methods: {
    
}
}
</script>

<style>

</style>