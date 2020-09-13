<template>
    <v-container>
        <h1 class="grey--text mb-8">Events to be organised by<br>
            <span class="primary--text">{{ inst.name }}</span>
        </h1>
        
        <v-row>
            <v-col col="12" sm="12" md="3" class="mb-6" v-for="event in eventsList" :key="event.id">
                <v-card
                    class="mx-auto"
                    max-width="400"
                    @click.prevent="expand(event.id)"
                >
                    <v-img
                    class="white--text align-end"
                    height="180px"
                    :src="`/storage/${ event.image }`"
                    aspect-ratio="1.7"  
                    >
                    </v-img>
                    <v-card-actions>
                        <v-list-item class="grow">
                            <v-list-item-avatar color="grey darken-3">
                            <v-img
                                class="elevation-6"
                                src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=White&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Light"
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
                            <v-icon class="mr-1">mdi-share-variant</v-icon>
                            </v-row>
                        </v-list-item>
                    </v-card-actions>

                    <v-card-title>{{ inst.name }}</v-card-title>

                    <v-card-subtitle class="pb-0">
                        {{ formattedDate(event.date, user.timezone) }} <br> 
                        {{ formattedStartTime(event.start_utc, user.timezone) }}  -  
                        {{ formattedEndTime(event.end_utc, user.timezone) }}
                    </v-card-subtitle>

                    <v-card-text class="text--primary">
                    <div>{{ event.title }}</div>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import moment from 'moment-timezone'

import { mapState, mapActions } from 'vuex'

export default {
    props: {
        user: Object
    },
    data: function(){
        return{
            id: this.$route.params.id,
        }
    },
    mounted(){
        this.$store.dispatch('student/fetchEventList', {
            id: this.id
        });
    },
    computed: {
        ...mapState('student', [
            'eventsList',
            'inst'
        ])
    },
    methods: {
        ...mapActions('student', [
            'likeInstEvent',
            'unlikeInstEvent'
        ]),
        like(id, liked){

            console.log(id);
            let liked_status = liked;

            if(liked_status){
                this.unlikeInstEvent({
                    user_id: this.user.id,
                    event_id: id,
                });
            }else{
                this.likeInstEvent({
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

</style>