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
                v-bind:dialogForReschedule="dialogForReschedule"
            ></emailtoparticipantslist-component>
        </v-container>
    </div>
</template>

<script>
import EmailToParticipantsDialog from './EmailToParticipantsDialogComponent'
import EmailToParticipantsList from './EmailToParticipantsListComponent'

import { mapState, mapMutations } from 'vuex'

export default {
    components: {
        EmailToParticipantsDialog,
        EmailToParticipantsList,
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
            'requestedEmails',
            'dialogForReschedule'
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