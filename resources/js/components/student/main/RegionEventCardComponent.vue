<template>
    <v-row>
        <v-col cols="12" sm="12" md="3" class="mb-6" v-for="(event, index) in events" :key="index">
            <v-card
                class="mx-auto"
                max-width="400"
                height="440"
                @click.prevent="expand(event.id)"
            >
                <v-img
                class="white--text align-end"
                height="180px"
                :src="event.absolute_path"
                aspect-ratio="1.7"  
                >
                </v-img>
                 <v-card-actions>
                    <v-list-item class="grow">
                        <v-list-item-avatar color="grey darken-3" size="28">
                        <v-img
                            class="elevation-6"
                            :src="`${event.icon}`"
                        ></v-img>
                        </v-list-item-avatar>

                        <v-row
                        align="center"
                        justify="end"
                        >
                        <v-icon 
                            @click.stop="like(`${event.id}`, event.liked_by_user)"
                            :color="event.liked_by_user == true ? 'error' : null"
                            class="like mr-3"
                        >mdi-heart</v-icon>
                        <!-- <v-icon class="mr-1">mdi-share-variant</v-icon> -->
                        </v-row>
                    </v-list-item>
                </v-card-actions>

                <v-card-title class="v-card__title pt-0">{{ event.name }}</v-card-title>

                <v-card-subtitle class="text--primary">
                    <div>{{ event.title }}</div>
                </v-card-subtitle>
                
                <v-card-text v-if="user !== null">
                    {{ formattedDate(event.date, user.timezone) }} <br> 
                    {{ formattedStartTime(event.start_utc, user.timezone) }}  -  
                    {{ formattedEndTime(event.end_utc, user.timezone) }}
                </v-card-text>
                <v-card-text v-if="user === null">
                    {{ formattedDate(event.date, event.timezone) }} <br> 
                    {{ formattedStartTime(event.start_utc, event.timezone) }}  -  
                    {{ formattedEndTime(event.end_utc, event.timezone) }}
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
import moment from 'moment-timezone'

import { mapState, mapActions } from 'vuex'

export default {
    props: {
        user: Object,
        events: Array
    },
    data: function(){
        return {
            selectedId: '',
        }
    },
    computed: {
        ...mapState('student', [
            'eventId',
            'allerror',
        ])
    },
    methods: {
        ...mapActions('student',[
            'RegionLikeEvent',
            'RegionUnlikeEvent',
        ]),
        like(id, liked){

            // console.log(id);
            let liked_status = liked;
             console.log(liked);

            if(liked_status){
                this.RegionUnlikeEvent({
                    user_id: this.user.id,
                    event_id: id,
                });
            }else{
                this.RegionLikeEvent({
                    user_id: this.user.id,
                    event_id: id,
                })
                
                // this.allEvents = this.allEvents.map(event => {
                //     if(event.id === this.eventId){
                //         event.liked_by_user = true
                //     }
                //     return event
                // })
            }
        },
        expand(id){
            this.$router.push({name: 'event-details', params: {id: id}})
        },
        formattedDate(value, timezone){
            return moment.utc(value).local().tz(timezone).format("ddd, MMM Do YYYY")
        },
        formattedStartTime(value, timezone){
            return moment.utc(value).local().tz(timezone).format("h:mm a")
        },
        formattedEndTime(value, timezone){
            return moment.utc(value).local().tz(timezone).format("h:mm a ([GMT] Z)")
        }
    }

}
</script>

<style>
.like{
    cursor: pointer;
}
.v-card__title{
    word-break: normal !important; /* maybe !important  */
}

</style>