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
        <v-row class="mb-14">
            <v-col col="12" sm="12" md="6">
                <participantcountrypie-component v-bind:id="id"></participantcountrypie-component>
            </v-col>
            <v-col col="12" sm="12" md="6">
                <participantcountrylist-component v-bind:id="id"></participantcountrylist-component>
            </v-col>
        </v-row>
        <v-row>
            <v-col col="12" sm="12" md="6" class="mb-14">
                <participantdestinationpie-component v-bind:id="id"></participantdestinationpie-component>
            </v-col>
        </v-row>
        <v-row>
            <v-col col="12" sm="12" md="6" class="mb-14">
                <participantlevelpie-component v-bind:id="id"></participantlevelpie-component>
            </v-col>
        </v-row>
        <v-row>
            <v-col col="12" sm="12" md="6" class="mb-14">
                <participantsubjectpie-component v-bind:id="id"></participantsubjectpie-component>
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
import ParticipantLevelPie from './ParticipantCountryPieComponent'
import ParticipantDestinationPie from './ParticipantDestinationPieComponent'
import ParticipantSubjectPie from './ParticipantSubjectPieComponent'

export default {
    components: {
        EventHeader,
        DashboardMenu,
        ParticipantCountryPie,
        ParticipantCountryList,
        ParticipantLevelPie,
        ParticipantDestinationPie,
        ParticipantSubjectPie
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