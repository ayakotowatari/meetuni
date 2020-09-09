<template>
    <v-container>
        <h1 class="primary--text mb-8">Booked Events</h1>
        <v-card flat v-for="event in events" :key="event.title">
            <v-row class="pa-3"> 
                <v-col cols="12" xs="12" md="2">
                    <v-img :src="`/storage/${ event.image }`" ></v-img>
                </v-col>
                <v-col cols="12" xs="12" md="2">
                    <div class="caption grey--text">Institution Name</div>
                    <div>{{ event.name }}</div>
                </v-col>
                <v-col cols="12" xs="12" md="2">
                    <div class="caption grey--text">Event Title</div>
                    <div>{{ event.title }}</div>
                </v-col>
                <v-col cols="6" xs="6" sm="4" md="2">
                    <div class="caption grey--text">Date</div>
                    <div>{{ formattedDate(event.date, user.timezone) }}</div>
                </v-col>
                <v-col cols="6" xs="6" sm="4" md="2">
                    <div class="caption grey--text">Time</div>
                    <div>{{ formattedStartTime(event.start_utc, user.timezone) }} 
                        - {{ formattedEndTime(event.end_utc, user.timezone) }} </div>
                </v-col>
                <v-col cols="12" xs="2" sm="2" md="1">
                    <div class="caption grey--text">Event Page</div>
                    <div>
                    <v-icon color="info darken-2">mdi-open-in-new</v-icon>
                    </div>
                </v-col>
                 <v-col cols="12" xs="2" sm="2" md="1">
                    <div class="caption grey--text">Cancel</div>
                    <div>
                    <v-icon color="grey" @click="cancel">mdi-table-cancel</v-icon>
                    </div>
                </v-col>
            </v-row>
            <v-divider></v-divider>
        </v-card>
    </v-container>
</template>

<script>
import moment from 'moment-timezone'

import { mapState, mapGetters } from "vuex"

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
            'events',
        ]),
    },
    methods: {
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