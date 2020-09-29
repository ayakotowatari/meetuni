<template>
    <div>
        <bookingdialog-component 
            v-bind:dialog="dialog"
            v-bind:user="user"
        ></bookingdialog-component>
        <v-container>
            <h1 class="mb-8"><span class="error--text">Liked</span> <span class="grey--text">Events</span></h1>
            <div v-if="likedEvents !== null">
                <v-card flat v-for="event in likedEvents" :key="event.id">
                    <v-row class="pa-3"> 
                        <v-col cols="12" xs="12" md="2">
                            <v-img :src="`/storage/${ event.image }`"></v-img>
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
                        <v-col cols="6" xs="6" sm="2" md="1">
                            <div class="mt-md-10">
                            <v-icon 
                                class="icon" 
                                :color="event.liked_by_user == true ? 'error' : null"
                                @click="like(`${event.id}`, event.liked_by_user)"
                            >mdi-heart</v-icon>
                            </div>
                        </v-col>
                        <v-col cols="6" xs="6" sm="2" md="1">
                            <div class="mt-md-10">
                            <v-btn 
                                v-if='event.booked_by_user == false'
                                color="primary" 
                                outlined 
                                @click="showDialog(`${event.id}`)"
                            >Book</v-btn>
                            <v-btn 
                                v-if='event.booked_by_user == true'
                                color="grey" 
                                outlined 
                            >Booked</v-btn>
                            </div>
                        </v-col>
                    </v-row>
                    <v-divider></v-divider>
                </v-card>
            </div>
            <div v-if="likedEvents == null">
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12" xs="12" md="4">
                            <h2 class="grey--text mt-8">You haven't followed any universities yet.</h2> 
                        </v-col>
                    </v-row>
                </v-container>
            </div>
        </v-container>
    </div>
</template>

<script>
import moment from 'moment-timezone'

import BookingDialog from './BookingDialogComponent'

import { mapState, mapActions } from "vuex"

export default {
    components: {
        BookingDialog
    },
    props: {
        user: Object,
    },
    data: function(){
        return{
            id: this.$route.params.id,
        }
    },
    mounted(){
        this.$store.dispatch('studentaccount/fetchLikedEvents', {
            id: this.id,
        })
    },
    computed: {
        ...mapState('studentaccount', [
            'likedEvents',
            'dialog',
            'isBooked',
        ]),
    },
    methods: {
        // ...mapMutations('studentaccount', {
        //     showDialog: 'showDialog'
        // }),
        ...mapActions('studentaccount',[
            'showDialogWithEventId',
            'unlikeEvent',
            'likeEvent'
        ]),
        showDialog(id){
            this.showDialogWithEventId({
                id: id
            })
        },
        like(id, liked){
            console.log('pushed');
            console.log(liked);

            let liked_status = liked;

            if(liked_status){
                this.unlikeEvent({
                    event_id: id,
                    user_id: this.user.id
                })
            }else{
                this.likeEvent({
                    event_id: id,
                    user_id: this.user.id
                })
            }
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
.icon{
    display:inline-block;
}

</style>