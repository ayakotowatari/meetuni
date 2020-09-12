<template>
    <div>
        <bookingdialog-component 
            v-bind:dialog="dialog"
            v-bind:event="event"
            v-bind:user="user"
        ></bookingdialog-component>
        <followdialog-component
            v-bind:dialog="dialog"
            v-bind:event="event"
            v-bind:user="user"
        ></followdialog-component> 
        <v-img 
            :src="`/storage/${ event.image }`" 
            cover 
            aspect-ratio="2.5"
        >
        </v-img>
        <v-container>
            <v-row>
                <v-col col="12" sm="12" md="12">
                    <div class="grey--text text--darken-1 institution-title">{{ event.name }}</div>
                     <v-btn 
                        v-if="isFollowed == false"
                        class="ma-2 hidden-sm-and-down" 
                        outlined      
                        color="primary"
                        @click="follow(`${event.inst_id}`, `${user.id}`)"
                    >Follow</v-btn>
                    <v-btn 
                        v-if="isFollowed"
                        class="ma-2 hidden-sm-and-down" 
                        outlined      
                        color="primary"
                        @click="unfollow(`${event.inst_id}`)"
                    >Followed</v-btn>
                </v-col>
            </v-row>
            <v-row>
                <v-col col="12" sm="12" md="12">
                    <div class="primary--text event-title mb-2">{{ event.title }}</div>
                </v-col>
            </v-row>
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
                    <span class="event-info">{{ formattedDate(event.date, user.timezone) }}</span>
                </v-col>
            </v-row>
            <v-row class="mb-6">
                <v-col col="12" sm="12" md="12">
                    <v-icon medium class="mr-8">mdi-clock-time-nine-outline</v-icon>
                    <span class="event-info">
                        {{ formattedStartTime(event.start_utc, user.timezone) }} - 
                        {{ formattedEndTime(event.end_utc, user.timezone) }}
                    </span>
                </v-col>
            </v-row>
            <v-row class="mb-6">
                <v-col col="12" sm="12" md="12">
                    <v-icon medium class="mr-8">mdi-book-multiple-outline</v-icon>
                    <span class="event-info mr-4" v-for="subject in subjects" :key=subject.id>
                        {{ subject.subject }}
                    </span>
                </v-col>
            </v-row>
            <v-row class="mb-6">
                <v-col col="12" sm="12" md="12">
                    <v-icon medium class="mr-8">mdi-earth</v-icon>
                    <span class="event-info mr-4" v-for="region in regions" :key=region.id>
                        {{ region.region }}
                    </span>
                </v-col>
            </v-row>
            <v-row class="mb-6">
                <v-col col="12" sm="12" md="12">
                    <v-icon medium class="mr-8">mdi-layers-triple-outline</v-icon>
                    <span class="event-info mr-4" v-for="level in levels" :key=level.id>
                        {{ level.level }}
                    </span>
                </v-col>
            </v-row>
            <v-btn 
                v-if="isBooked==false"
                class="ma-2 hidden-sm-and-down" 
                dark     
                block
                color="primary"
                @click="showDialog"
            >Book</v-btn>
             <v-btn 
                v-if="isBooked"
                class="ma-2 hidden-sm-and-down" 
                outlined    
                block
                color="primary"
            >Booked</v-btn>
        </v-container>
        <v-bottom-navigation class="hidden-md-and-up" background-color="primary" grow dark fixed>
            <v-btn>
                <span>BOOK</span>
                <v-icon>mdi-calendar-check-outline</v-icon>
            </v-btn>
        </v-bottom-navigation>
    </div>
</template>

<script>
import moment from 'moment-timezone'

import BookingDialog from './BookingDialogComponent'
import FollowDialog from '../account/FollowDialogComponent'

import { mapState, mapMutations, mapActions } from 'vuex'

// import {createNamespacedHelpers} from 'vuex'
// const { mapState, mapGetters } = createNamespacedHelpers('student');

export default {
    props: {
        user: Array,
    },
    components: {
        BookingDialog,
        FollowDialog
    },
    data: function(){
        return{
            id: this.$route.params.id,
        }
        console.log(id);
    },
    mounted(){
        this.$store.dispatch('student/fetchSingleEvent', {
            id: this.id
        })
    },
    computed: {
        ...mapState('student', [
            'event',
            'regions',
            'levels',
            'subjects',
        ]),
        ...mapState('studentaccount', [
            'dialog',
            'isFollowed',
            'isBooked'
        ])
    },
    methods: {
        ...mapMutations('studentaccount', {
            showDialog: 'showDialog'
        }),
        ...mapActions('studentaccount', [
            'followInst'
        ]),
        follow(id, user_id){
            console.log(id);
            console.log(user_id);
            
            this.followInst({
                inst_id: id,
                user_id: user_id
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
        font-size: 28px;
    }
    .event-title{
        font-size: 24px;
    }
    .btn-text{
        font-size: 24px;
    }
}


</style>