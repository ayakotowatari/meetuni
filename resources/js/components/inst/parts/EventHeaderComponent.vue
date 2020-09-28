<template>
    <v-container>
        <v-row>
            <v-col>
                <h2 class="grey--text text--darken-4">{{ event.title }}</h2> 
                <div>{{ formattedDate(event.date, user.timezone) }}</div>
                <div>
                {{ formattedStartTime(event.start_utc, user.timezone) }} - 
                {{ formattedEndTime(event.end_utc, user.timezone) }}
                </div>
                <div>
                    <span>Targets:</span>
                    <span v-for="region in eventRegions" :key="region.region" class="ml-3">{{ region.region }}</span>
                </div>
                <div>
                    <span>Levels:</span>
                    <span v-for="level in eventLevels" :key="level.level" class="ml-3">{{ level.level }}</span>
                </div>
                <div>
                    <span>Subjects:</span>
                    <span v-for="subject in eventSubjects" :key="subject.subject" class="ml-3">{{ subject.subject }}</span>
                </div>
            </v-col>  
        </v-row>
    </v-container>
</template>

<script>
import moment from 'moment-timezone'

import { mapState } from 'vuex'

export default {
    data: function(){
        return{
            id: this.$route.params.id,
        }
        console.log(id);
    },
    mounted(){
    this.$store.dispatch('fetchUser');
    this.$store.dispatch('fetchSingleEvent', {
        id: this.id
    });
    this.$store.dispatch('fetchEventRegions', {
        id: this.id
    });
    this.$store.dispatch('fetchEventLevels', {
        id: this.id
    });
    this.$store.dispatch('fetchEventSubjects', {
        id: this.id
    });
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
        }
    },
    computed: {
    ...mapState ([
        'user',
        'event',
        'eventRegions',
        'eventLevels',
        'eventSubjects'
    ])
}
}


</script>

<style>

</style>