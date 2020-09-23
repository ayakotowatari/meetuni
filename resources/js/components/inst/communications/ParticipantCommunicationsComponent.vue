<template>
    <div>
        <emailtoparticipantsdialog-component
            v-bind:dialog="dialog"
            v-bind:user="user"
        ></emailtoparticipantsdialog-component>
        <v-container>
            <h1 class="grey--text mb-6">Communications</h1>
            <v-btn 
                color="primary"
                outlined
                class='mb-6'
                @click="showDialog"
            >Draft emails to registrants</v-btn>
            <emailtoparticipantslist-component
                v-bind:emails="requestedEmails"
                v-bind:dialog="dialogForSchedule"
            ></emailtoparticipantslist-component>
        </v-container>
    </div>
</template>

<script>
import EmailToParticipantsDialog from './EmailToParticipantsDialogComponent'
import EmailToParticipantsList from './EmailToParticipantsListComponent'
import ScheduleEmailDialog from './ScheduleEmailDialogComponent'

import { mapState, mapMutations } from 'vuex'

export default {
    components: {
        EmailToParticipantsDialog,
        EmailToParticipantsList,
        ScheduleEmailDialog
    },
    props: {
        user: Object
    },
    data: function(){
        return{
                id: this.$route.params.id,
            }

    },
    mounted(){
        this.$store.dispatch('notifications/fetchEmailsToParticipantsList');
    },
    computed: {
        ...mapState('notifications', [
            'dialog',
            'dialogForSchedule',
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