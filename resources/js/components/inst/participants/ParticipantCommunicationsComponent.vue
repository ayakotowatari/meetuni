<template>
    <div>
        <emailtoparticipantsdialog-component
            v-bind:dialog="dialog"
        ></emailtoparticipantsdialog-component>
        <v-container>
            <v-row class="mb-8">
                    <v-col col="12" sm="12" md="8">
                        <eventheader-component></eventheader-component>
                    </v-col>
                </v-row>
                <v-row class="mb-8">
                    <h1 class="grey--text mb-6">Communications</h1>
                    <v-spacer></v-spacer>
                    <v-col col="12" sm="12" md="2">
                        <dashboardmenu-component v-bind:id="id"></dashboardmenu-component>
                    </v-col>
            </v-row>
            <v-btn 
                color="primary"
                outlined
                class='mb-6'
                @click="showDialog"
            >Send emails to registrants</v-btn>
            <emailtoparticipantslist-component
                v-bind:emails="requestedEmails"
            ></emailtoparticipantslist-component>
        </v-container>
    </div>
</template>

<script>
import EventHeader from '../parts/EventHeaderComponent'
import DashboardMenu from '../dashboard/DashboardMenuComponent'
import EmailToParticipantsDialog from './EmailToParticipantsDialogComponent'
import EmailToParticipantsList from './EmailToParticipantsListComponent'

import { mapState, mapMutations } from 'vuex'

export default {
    components: {
        EventHeader,
        DashboardMenu,
        EmailToParticipantsDialog,
        EmailToParticipantsList
    },
    data: function(){
        return{
                id: this.$route.params.id,
            }

    },
    mounted(){
        this.$store.dispatch('notifications/fetchEmailsToParticipantsList', {
            id: this.id
        });
    },
    computed: {
        ...mapState('notifications', [
            'dialog',
            'requestedEmails'
        ])
    },
    methods: {
        ...mapMutations('notifications', {
            showDialog: 'showDialog'
        })
    }

}
</script>

<style>

</style>