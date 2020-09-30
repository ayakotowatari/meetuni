<template>
<v-container>
    <eventcard-component
        v-bind:events="allEvents"
        v-bind:user="user"
    ></eventcard-component>
</v-container>
</template>

<script>
import moment from 'moment-timezone'

import EventCard from './EventCardComponent'

import { mapState } from 'vuex'
// import {createNamespacedHelpers} from 'vuex'
// const { mapState } = createNamespacedHelpers('student');

export default {
    components: {
        EventCard
    },
    props: {
        user: Object,
        isLoggedIn:Boolean
    },
    data: () => ({

    }),
    mounted(){
        this.$store.dispatch('student/fetchAllEvents');
    },
    computed: {
        ...mapState('student', [
            'allEvents',
        ])
    },
    methods: {
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
.card-link{
    cursor: pointer;
}

</style>