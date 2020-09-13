<template>
    <div>
        <cancellationdialog-component
            v-bind:dialog="dialog"
        ></cancellationdialog-component>
        <v-container>
            <h1 class="primary--text mb-8">Booked Events</h1>
            <v-card flat v-for="booking in bookings" :key="booking.title">
                <v-row class="pa-3"> 
                    <v-col cols="12" xs="12" md="2">
                        <v-img :src="`/storage/${ booking.image }`" ></v-img>
                    </v-col>
                    <v-col cols="12" xs="12" md="2">
                        <div class="caption grey--text">Institution Name</div>
                        <div>{{ booking.name }}</div>
                    </v-col>
                    <v-col cols="12" xs="12" md="2">
                        <div class="caption grey--text">Event Title</div>
                        <div>{{ booking.title }}</div>
                    </v-col>
                    <v-col cols="6" xs="6" sm="4" md="2">
                        <div class="caption grey--text">Date</div>
                        <div>{{ formattedDate(booking.date, user.timezone) }}</div>
                    </v-col>
                    <v-col cols="6" xs="6" sm="4" md="2">
                        <div class="caption grey--text">Time</div>
                        <div>{{ formattedStartTime(booking.start_utc, user.timezone) }} 
                            - {{ formattedEndTime(booking.end_utc, user.timezone) }} </div>
                    </v-col>
                    <v-col cols="12" xs="2" sm="2" md="1">
                        <div class="caption grey--text">Event Page</div>
                        <div>
                        <v-icon color="info darken-2" @click="toEventPage(`${booking.event_id}`)">mdi-open-in-new</v-icon>
                        </div>
                    </v-col>
                    <v-col cols="12" xs="2" sm="2" md="1">
                        <div class="caption grey--text">Cancel</div>
                        <div>
                        <v-icon color="grey" @click="showDialog(`${booking.id}`)">mdi-table-cancel</v-icon>
                        </div>
                    </v-col>
                </v-row>
                <v-divider></v-divider>
            </v-card>
        </v-container>
    </div>
</template>

<script>
import moment from 'moment-timezone'

import { mapState, mapActions } from "vuex"

export default {
    props: {
        user: Object,
    },
    data: function(){
        return{
            id: this.$route.params.id,
        }
    },
    mounted(){
        this.$store.dispatch('studentaccount/fetchBookedEvents', {
            id: this.id
        })
    },
    computed: {
        ...mapState('studentaccount', [
            'bookings',
            'dialog',
            'isBooked',
        ]),
    },
    methods: {
        // ...mapMutations('studentaccount', {
        //     showDialog: 'showDialog'
        // }),
        ...mapActions('studentaccount',[
            'showDialogWithBookingId'
        ]),
        showDialog(id){
            this.showDialogWithBookingId({
                id: id
            })
        },
        toEventPage(id){
            this.$router.push({name: 'event-page', params: {id: id}})
        },
        formattedDate(value, timezone){
            return moment.utc(value).local().tz(timezone).format("ddd, MMM Do YYYY")
        },
        formattedStartTime(value, timezone){
            return moment.utc(value).local().tz(timezone).format("h:mm a")
        },
        formattedEndTime(value, timezone){
            return moment.utc(value).local().tz(timezone).format("h:mm a ([GMT] Z)")
        },
    }
}
</script>

<style>

</style>