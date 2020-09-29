<template>
    <div>
        <emailtoparticipantsdialog2-component
            v-bind:dialog="dialog"
            v-bind:user="user"
        ></emailtoparticipantsdialog2-component>
        <v-container>
            <v-row class="mb-8">
                <v-col cols="12" sm="12" md="8">
                    <eventheader-component></eventheader-component>
                </v-col>
            </v-row>
            <v-row class="mb-8">
                <h1 class="grey--text mb-6">Manage Participants</h1>
                <v-spacer></v-spacer>
                <v-col cols="12" sm="12" md="2">
                    <dashboardmenu-component v-bind:id="id"></dashboardmenu-component>
                </v-col>
            </v-row>
            <v-btn 
                color="primary"
                outlined
                class='mb-6'
                @click="showDialog"
            >Draft emails to registrants</v-btn>
            <v-row justify="center" class="mb-6">
                <v-col cols="12" sm="12" md="12">
                    <h2 class="grey--text text--darken-1">Participants List</h2>
                </v-col>
            </v-row>
            <div class="mb-12">
                <participantslist-component v-bind:id="id"></participantslist-component>
            </div>
        </v-container>
    </div>
</template>

<script>
import moment from 'moment-timezone'

import EventHeader from '../parts/EventHeaderComponent'
import DashboardMenu from '../dashboard/DashboardMenuComponent'
import ParticipantsList from './ParticipantsListComponent'
import EmailToParticipantsDialog from './EmailToParticipantsDialogComponent'

import { mapState, mapMutations } from 'vuex'


export default {
    components: {
        EventHeader,
        DashboardMenu,
        ParticipantsList,
        EmailToParticipantsDialog
    },
    props: {
        user: Object
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
    computed: {
        ...mapState ('notifications', [
            'dialog'
        ])
    },
    methods: {
        ...mapMutations ('notifications', {
            showDialog: 'showDialog',
        })
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
   
    }
</script>

<style>

</style>