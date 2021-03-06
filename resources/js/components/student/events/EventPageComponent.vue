<template>
    <div>
        <questionsdialog-component 
            v-bind:dialog="dialog"
            v-bind:event="event"
            v-bind:user="user"
        ></questionsdialog-component>
        <followdialog-component
            v-bind:dialog="followDialog"
            v-bind:event="event"
            v-bind:user="user"
        ></followdialog-component> 
        <div v-if="event !== null">
            <v-img 
                :src="event.absolute_path" 
                cover 
                aspect-ratio="2.5"
            >
            </v-img>
            <v-container>
                <v-row>
                    <v-col col="12" sm="12" md="6">
                        <div>{{ formattedDate(event.date, user.timezone) }}</div>
                        <span class="event-info">
                            {{ formattedStartTime(event.start_utc, user.timezone) }} - 
                            {{ formattedEndTime(event.end_utc, user.timezone) }}
                        </span>
                        <div class="primary--text event-title mb-4">{{ event.title }}</div>
                        <div class="grey--text text--darken-1 institution-title mb-1">
                            <span class="organiser">Organiser:</span> {{ inst.name }}
                        </div>
                        <div class="mb-8">
                            <v-btn 
                                v-if="inst.followed_by_user == false"
                                class="ma-2 hidden-sm-and-down" 
                                outlined      
                                color="primary"
                                @click="follow(`${inst.id}`, `${user.id}`)"
                            >Follow</v-btn>
                            <v-btn 
                                v-if="inst.followed_by_user == true"
                                class="ma-2 hidden-sm-and-down" 
                                outlined      
                                color="primary"
                                @click="unfollow(`${inst.id}`, `${user.id}`)"
                            >Followed</v-btn>
                        </div>
                        <div class="event-info mr-4">
                            {{ event.description }}
                        </div>
                    </v-col>
                    <v-col col="12" sm="12" md="6" class="hidden-sm-and-down">
                        <v-card dark color="info darken-3" flat class="mx-auto pb-4 px-4">
                            <v-card-title>Have any questions?</v-card-title>
                            <v-card-subtitle>Take this chance to ask questions before the event so that the organiser can talk about exactly what you are interested in!</v-card-subtitle>
                            <v-card-actions>
                                <v-btn
                                    text
                                    @click="showDialog"
                                >Ask questions <v-icon right dark>mdi-account-question-outline</v-icon>
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
                <v-row class="hidden-md-and-up">
                    <v-col col="12" sm="12">
                        <v-card dark color="info darken-3" flat class="mb-10 pb-4 px-4">
                            <v-card-title>Have any questions?</v-card-title>
                            <v-card-subtitle>Take this chance to ask questions before the event so that the organiser can talk about exactly what you are interested in!</v-card-subtitle>
                            <v-card-actions>
                                <v-btn
                                    text
                                    @click="showDialog"
                                >Ask questions <v-icon right dark>mdi-account-question-outline</v-icon>
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
            <v-bottom-navigation class="hidden-md-and-up" background-color="primary" grow dark fixed>
                <v-btn>
                    <span>Tap Here to Join the Event</span>
                    <v-icon>mdi-account-group-outline</v-icon>
                </v-btn>
            </v-bottom-navigation>
        </div>
        <div v-if="event == null">
            <v-container>
                <v-row justify="center">
                    <v-col col="12" xs="12" md="4">
                        <h2 class="grey--text mt-8">You haven't booked a place for this event.</h2> 
                    </v-col>
                </v-row>
            </v-container>
        </div>
    </div>
</template>

<script>
import moment from 'moment-timezone'

import QuestionsDialog from './QuestionsDialogComponent'
import FollowDialog from './FollowDialogComponent'

import { mapState, mapMutations, mapActions } from 'vuex'

// import {createNamespacedHelpers} from 'vuex'
// const { mapState, mapGetters } = createNamespacedHelpers('student');

export default {
    props: {
        user: Object,
    },
    components: {
        QuestionsDialog,
        FollowDialog
    },
    data: function(){
        return{
            id: this.$route.params.id,
        }
        console.log(id);
    },
    mounted(){
        this.$store.dispatch('student/fetchSingleBookedEvent', {
            id: this.id
        });
        this.$store.dispatch('studentaccount/fetchInst', {
            id: this.id
        });
    },
    computed: {
        ...mapState('student', [
            'event',
            'regions',
            'levels',
            'subjects',
        ]),
        ...mapState('studentaccount', [
            'inst',
            'dialog',
            'followDialog',
            'isFollowed',
            'isBooked'
        ])
    },
    methods: {
        ...mapMutations('studentaccount', {
            showDialog: 'showDialog'
        }),
         ...mapActions('studentaccount', [
            'followInst',
            'unfollowInst'
        ]),
        follow(id, user_id){
            console.log(id);
            console.log(user_id);

            this.followInst({
                inst_id: id,
                user_id: user_id
            })
        },
        unfollow(id, user_id){
            console.log(id);
            console.log(user_id);

            this.unfollowInst({
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

<style scoped>
.institution-title{
    font-size: 24px;
}
.organiser{
    font-size: 16px;
    margin-right: 20px;
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
        font-size: 18px;
        margin-bottom: 32px;
    }
    .event-title{
        font-size: 24px;
    }
    .event-info{
        margin-bottom: 40px;
    }
    .btn-text{
        font-size: 24px;
    }
}


</style>