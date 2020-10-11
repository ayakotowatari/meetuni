<template>
    <v-container>
        <searchevents-component></searchevents-component>
        <h1 class="mb-8"><span class="grey--text">Search</span> <span class="primary--text">Results</span></h1>
        <div v-if="results !== null">
            <v-card flat v-for="result in results" :key="result.id">
                <v-row class="pa-3"> 
                    <v-col cols="12" xs="12" md="2">
                        <v-img :src="result.absolute_path"></v-img>
                    </v-col>
                    <v-col cols="12" xs="12" md="2">
                        <div class="caption grey--text">Institution Name</div>
                        <div>{{ result.inst_name }}</div>
                    </v-col>
                    <v-col cols="12" xs="12" md="2">
                        <div class="caption grey--text">Event Title</div>
                        <div>{{ result.title }}</div>
                    </v-col>
                    <v-col v-if="user !== null" cols="6" xs="6" sm="4" md="2">
                        <div class="caption grey--text">Date</div>
                        <div>{{ formattedDate(result.date, user.timezone) }}</div>
                    </v-col>
                    <v-col v-if="user == null" cols="6" xs="6" sm="4" md="2">
                        <div class="caption grey--text">Date</div>
                        <div>{{ formattedDate(result.date, result.timezone) }}</div>
                    </v-col>
                    <v-col v-if="user !== null" cols="6" xs="6" sm="4" md="2">
                        <div class="caption grey--text">Time</div>
                        <div>{{ formattedStartTime(result.start_utc, user.timezone) }} 
                            - {{ formattedEndTime(result.end_utc, user.timezone) }} </div>
                    </v-col>
                    <v-col v-if="user == null" cols="6" xs="6" sm="4" md="2">
                        <div class="caption grey--text">Time</div>
                        <div>{{ formattedStartTime(result.start_utc, result.timezone) }} 
                            - {{ formattedEndTime(result.end_utc, result.timezone) }} </div>
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
        <div v-if="results == 0">
            <v-container>
                <v-row justify="center">
                    <v-col cols="12" xs="12" md="4">
                        <h2 class="grey--text mt-8">Sorry, no search results. Try again.</h2> 
                    </v-col>
                </v-row>
            </v-container>
        </div>
    </v-container>
</template>

<script>
import SearchEvents from './SearchEventsComponent'

export default {
    components: {
        SearchEvents
    },
    props: {
        user: Object,
    },
    data: function(){
        return {
            results: [],
        }
    },


}
</script>

<style>

</style>