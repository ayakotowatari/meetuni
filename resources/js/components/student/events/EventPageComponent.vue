<template>
    <div>
        <questionsdialog-component 
            v-bind:dialog="dialog"
            v-bind:event="event"
            v-bind:user="user"
        ></questionsdialog-component>
        
        <v-img 
            :src="`/storage/${ event.image }`" 
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
                    <div class="primary--text event-title mb-2">{{ event.title }}</div>
                    <div class="grey--text text--darken-1 institution-title"><span class="organiser">Organiser:</span> {{ event.name }}</div>
                    <v-btn 
                        class="ma-2 mb-8 hidden-sm-and-down" 
                        outlined      
                        color="primary"
                        @click="showDialog"
                    >Follow</v-btn>
                    <div class="event-info mr-4">
                        {{ event.description }}
                    </div>
                </v-col>
                <v-col col="12" sm="12" md="6" class="hidden-sm-and-down">
                    <v-card dark color="info darken-3" flat class="mx-auto pb-4 px-4">
                        <v-card-title>Have any questions?</v-card-title>
                        <v-card-subtitle>Take this chance to ask questions before the event so that the organiser can talk about exactly what you are interested in!</v-card-subtitle>
                        <v-card-action>
                            <v-btn
                                text
                                @click="showDialog"
                            >Ask questions <v-icon right dark>mdi-account-question-outline</v-icon>
                            </v-btn>
                        </v-card-action>
                    </v-card>
                </v-col>
            </v-row>
            <v-row class="hidden-md-and-up">
                 <v-col col="12" sm="12">
                    <v-card dark color="info darken-3" flat class="mb-10 pb-4 px-4">
                        <v-card-title>Have any questions?</v-card-title>
                        <v-card-subtitle>Take this chance to ask questions before the event so that the organiser can talk about exactly what you are interested in!</v-card-subtitle>
                        <v-card-action>
                            <v-btn
                                text
                            >Ask questions <v-icon right dark>mdi-account-question-outline</v-icon>
                            </v-btn>
                        </v-card-action>
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
</template>

<script>
import moment from 'moment-timezone'

import QuestionsDialog from './QuestionsDialogComponent'

import { mapState, mapMutations } from 'vuex'

// import {createNamespacedHelpers} from 'vuex'
// const { mapState, mapGetters } = createNamespacedHelpers('student');

export default {
    props: {
        user: Array,
    },
    components: {
        QuestionsDialog
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
            'isBooked'
        ])
    },
    methods: {
        ...mapMutations('studentaccount', {
            showDialog: 'showDialog'
        }),
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