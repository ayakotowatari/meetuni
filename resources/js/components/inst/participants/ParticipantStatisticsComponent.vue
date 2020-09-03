<template>
    <v-container>
        <v-row class="mb-8">
            <v-col col="12" sm="12" md="8">
                <eventheader-component></eventheader-component>
            </v-col>
        </v-row>
        <v-row class="mb-8">
            <h1 class="grey--text mb-6">Participant Statistics</h1>
            <v-spacer></v-spacer>
            <v-col col="12" sm="12" md="2">
                <dashboardmenu-component v-bind:id="id"></dashboardmenu-component>
            </v-col>
        </v-row>
        <v-row justify="center" class="mb-6">
        <v-col cols="12" sm="12" md="12">
            <h2 class="grey--text text--darken-1">Country of Origins</h2>
        </v-col>
        </v-row>
        <v-row class="mb-14">
            <v-col col="12" sm="12" md="6">
                <participantcountrypie-component v-bind:id="id"></participantcountrypie-component>
            </v-col>
            <v-col col="12" sm="12" md="6">
                <participantcountrylist-component v-bind:id="id"></participantcountrylist-component>
            </v-col>
        </v-row>
        <v-col cols="12" sm="12" md="12">
            <h2 class="grey--text text--darken-1">Desired Destinations</h2>
        </v-col>
        <v-row class="mb-14">
            <v-col col="12" sm="12" md="6" >
                <participantdestinationpie-component v-bind:id="id"></participantdestinationpie-component>
            </v-col>
            <v-col col="12" sm="12" md="6">
                <participantdestinationlist-component v-bind:id="id"></participantdestinationlist-component>
            </v-col>
        </v-row>
        <v-col cols="12" sm="12" md="12">
            <h2 class="grey--text text--darken-1">Desired Levels of Study</h2>
        </v-col>
        <v-row class="mb-14">
            <v-col col="12" sm="12" md="6">
                <participantlevelpie-component v-bind:id="id"></participantlevelpie-component>
            </v-col>
            <v-col col="12" sm="12" md="6">
                <participantlevellist-component v-bind:id="id"></participantlevellist-component>
            </v-col>
        </v-row>
        <v-col cols="12" sm="12" md="12">
            <h2 class="grey--text text--darken-1">Subject Areas of Interest</h2>
        </v-col>
        <v-row justify="center" class="mb-14">
            <v-col col="12" sm="12" md="6">
                <participantsubjectbar-component v-bind:id="id"></participantsubjectbar-component>
            </v-col>
            <v-col col="12" sm="12" md="6">
                <participantsubjectlist-component v-bind:id="id"></participantsubjectlist-component>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import moment from 'moment-timezone'
import EventHeader from '../parts/EventHeaderComponent'
import DashboardMenu from '../dashboard/DashboardMenuComponent'
import ParticipantCountryPie from './ParticipantCountryPieComponent'
import ParticipantCountryList from './ParticipantCountryListComponent'
import ParticipantDestinationPie from './ParticipantDestinationPieComponent'
import ParticipantDestinationList from './ParticipantDestinationListComponent'
import ParticipantLevelPie from './ParticipantLevelPieComponent'
import ParticipantLevelList from './ParticipantLevelListComponent'
import ParticipantSubjectBar from './ParticipantSubjectBarComponent'
import ParticipantSubjectList from './ParticipantSubjectListComponent'

export default {
    components: {
        EventHeader,
        DashboardMenu,
        ParticipantCountryPie,
        ParticipantCountryList,
        ParticipantDestinationPie,
        ParticipantDestinationList,
        ParticipantLevelPie,
        ParticipantLevelList,
        ParticipantSubjectBar,
        ParticipantSubjectList
    },
    data: function(){
        return{
            id: this.$route.params.id,
        }
    }
}
</script>

<style>

</style>