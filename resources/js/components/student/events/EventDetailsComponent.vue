<template>
    <div>
        <tobookdialog-component
            v-bind:eventId="eventId"
            v-bind:dialog="dialogForLoginToBook"
        >
        </tobookdialog-component>
        <tofollowdialog-component
            v-bind:dialog="dialogForLoginToFollow"
            v-bind:eventId="eventId"
        ></tofollowdialog-component>
        <bookingdialog2-component 
            v-bind:dialog="dialog"
            v-bind:event="event"
            v-bind:user="user"
        ></bookingdialog2-component>
        <followdialog-component
            v-bind:dialog="followDialog"
            v-bind:event="event"
            v-bind:user="user"
        ></followdialog-component> 
       
        <v-img 
            :src="event.absolute_path" 
            cover 
            aspect-ratio="2.5"
        >
        </v-img>
        <v-container>
            <v-row align="center">
                <v-col cols="12" sm="12" md="6">
                    <span class="grey--text text--darken-1 institution-title">{{ inst.name }}</span>
                </v-col>
                <v-col cols="12" sm="12" md="2">
                    <v-avatar class="hidden-md-and-up" size="28">
                        <v-img
                            :src="`${event.icon}`"
                        ></v-img>
                    </v-avatar>
                    <v-avatar class="hidden-sm-and-down" size="32">
                        <v-img
                            :src="`${event.icon}`"
                        ></v-img>
                    </v-avatar>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" sm="12" md="12">
                    <v-btn 
                        v-if="inst.followed_by_user == false"
                        outlined      
                        color="primary"
                        @click="follow(`${inst.id}`, `${event.id}`)"
                    >Follow</v-btn>
                    <v-btn 
                        v-if="inst.followed_by_user == true"
                        outlined      
                        color="primary"
                        @click="unfollow(`${inst.id}`)"
                    >Followed</v-btn>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" sm="12" md="12">
                    <div class="primary--text event-title mb-2">{{ event.title }}</div>
                </v-col>
            </v-row>
            <div v-if="user !== null">
                <v-row class="mb-8">
                    <v-col col="12" sm="12" md="6">
                        <div class="event-info mr-4">
                            {{ event.description }}
                        </div>
                    </v-col>
                </v-row>
                <v-row class="mb-6">
                    <v-col cols="12" sm="12" md="12">
                        <v-icon medium class="mr-8">mdi-calendar-month-outline</v-icon>
                        <span class="event-info">{{ formattedDate(event.date, user.timezone) }}</span>
                    </v-col>
                </v-row>
                <v-row class="mb-6">
                    <v-col cols="12" sm="12" md="12">
                        <v-icon medium class="mr-8">mdi-clock-time-nine-outline</v-icon>
                        <span class="event-info">
                            {{ formattedStartTime(event.start_utc, user.timezone) }} - 
                            {{ formattedEndTime(event.end_utc, user.timezone) }}
                        </span>
                    </v-col>
                </v-row>
            </div>
             <div v-if="user == null">
                <v-row class="mb-8">
                    <v-col col="12" sm="12" md="6">
                        <div class="event-info mr-4">
                            {{ event.description }}
                        </div>
                    </v-col>
                </v-row>
                <v-row class="mb-6">
                    <v-col col="12" sm="12" md="12">
                        <v-icon medium class="mr-8">mdi-calendar-month-outline</v-icon>
                        <span class="event-info">{{ formattedDate(event.date, event.timezone) }}</span>
                    </v-col>
                </v-row>
                <v-row class="mb-6">
                    <v-col cols="12" sm="12" md="12">
                        <v-icon medium class="mr-8">mdi-clock-time-nine-outline</v-icon>
                        <span class="event-info">
                            {{ formattedStartTime(event.start_utc, event.timezone) }} - 
                            {{ formattedEndTime(event.end_utc, event.timezone) }}
                        </span>
                    </v-col>
                </v-row>
            </div>
            <v-row class="mb-6">
                <v-col cols="12" sm="12" md="12">
                    <v-icon medium class="mr-8">mdi-book-multiple-outline</v-icon>
                    <span class="event-info mr-4" v-for="subject in subjects" :key=subject.id>
                        {{ subject.subject }}
                    </span>
                </v-col>
            </v-row>
            <v-row class="mb-6">
                <v-col cols="12" sm="12" md="12">
                    <v-icon medium class="mr-8">mdi-earth</v-icon>
                    <span class="event-info mr-4" v-for="region in regions" :key=region.id>
                        {{ region.region }}
                    </span>
                </v-col>
            </v-row>
            <v-row class="mb-6">
                <v-col cols="12" sm="12" md="12">
                    <v-icon medium class="mr-8">mdi-layers-triple-outline</v-icon>
                    <span class="event-info mr-4" v-for="level in levels" :key=level.id>
                        {{ level.level }}
                    </span>
                </v-col>
            </v-row>
            <v-btn 
                v-if="event.booked_by_user == false"
                class="ma-2 hidden-sm-and-down" 
                dark     
                block
                color="primary"
                @click.stop="showDialog(event.id)"
            >book</v-btn>
             <v-btn 
                v-if="event.booked_by_user == true"
                class="ma-2 hidden-sm-and-down" 
                outlined    
                block
                color="primary"
            >booked</v-btn>
        </v-container>
        <v-bottom-navigation class="hidden-md-and-up" background-color="primary" grow dark fixed>
            <v-btn>
                <span>book</span>
                <v-icon>mdi-calendar-check-outline</v-icon>
            </v-btn>
        </v-bottom-navigation>
    </div>
</template>

<script>
import moment from 'moment-timezone'

import BookingDialog from './BookingDialogComponent'
import FollowDialog from './FollowDialogComponent'
import ToBookDialog from '../auth/ToBookDialogComponent'
import ToFollowDialog from '../auth/ToFollowDialogComponent'

import { mapState, mapMutations, mapActions } from 'vuex'

// import {createNamespacedHelpers} from 'vuex'
// const { mapState, mapGetters } = createNamespacedHelpers('student');

export default {
    props: {
        user: Object,
    },
    components: {
        BookingDialog,
        FollowDialog,
        ToBookDialog,
        ToFollowDialog
    },
    data: function(){
        return{
            id: this.$route.params.id,
        }
        console.log(id);
    },
    mounted(){
        this.$store.dispatch('studentaccount/fetchSingleEvent', {
            id: this.id
        }),
        this.$store.dispatch('studentaccount/fetchInst', {
            id: this.id
        }),
        this.$store.dispatch('studentaccount/followInst', {
            inst_id: window.localStorage.getItem('instId')
        })

    },
    computed: {
        ...mapState('studentaccount', [
            'event',
            'regions',
            'levels',
            'subjects',
            'inst',
            'dialog',
            'followDialog',
            'isFollowed',
            'isBooked',
            'dialogForLoginToBook',
            'dialogForLoginToFollow',
            'eventId'
        ])
    },
    methods: {
        ...mapMutations('studentaccount', {
            // showDialog: 'showDialog',
        }),
        ...mapActions('studentaccount', [
            'followInst',
            'unfollowInst',
            'showDialogForBooking',
            'showDialogForLoginToBook',
            'showDialogForLoginToFollow',
        ]),
        showDialog(id){

            if(this.user !== null){
                this.showDialogForBooking({
                    event_id: id
                 })
            }else{
                this.showDialogForLoginToBook({
                    event_id: id
                })
            }
           
        },
        follow(id, event_id){
            // console.log(id);
            // console.log(user_id);
            // console.log('checked');
            // console.log(event_id);

            if(this.user !== null){
                this.followInst({
                    inst_id: id,
                })
            }else{
                localStorage.setItem('instId',id);
                this.showDialogForLoginToFollow({
                    event_id: event_id
                });
            }
            
        },
        unfollow(id){
            // console.log(id);

            this.unfollowInst({
                inst_id: id,
            })
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
    vertical-align: middle;
}
.avatar{
    line-height: 48px;
}
.institution-title{
    font-size: 48px;
}
.event-title{
    font-size: 32px;
    font-weight: bolder;
}
.event-info{
    font-size: 18px;
    max-width: 600px;
}
.additional-info{
    font-size: 14px;
}

@media(max-width:780px){
    .institution-title{
        font-size: 24px;
    }
    .event-title{
        font-size: 20px;
    }
    .event-info{
        font-size: 16px;
    }
    .btn-text{
        font-size: 24px;
    }
}


</style>