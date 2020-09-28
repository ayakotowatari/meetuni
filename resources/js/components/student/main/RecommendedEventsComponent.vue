<template>
<v-container>
    <h2 class="grey--text text--darken-2">Your subject insterests</h2>
    <subjecteventcard-component
        v-bind:events="recommendedSubjectEvents"
        v-bind:user="user"
        class="mb-10"
    ></subjecteventcard-component>
    <h2 class="grey--text text--darken-2">From countries of your interest</h2>
    <destinationeventcard-component
        v-bind:events="recommendedDestinationEvents"
        v-bind:user="user"
        class="mb-10"
    ></destinationeventcard-component>
    <h2 class="grey--text text--darken-2">Focus on your region</h2>
    <regioneventcard-component
        v-bind:events="recommendedRegionEvents"
        v-bind:user="user"
        class="mb-10"
    ></regioneventcard-component>
</v-container>
</template>

<script>
import SubjectEventCard from './SubjectEventCardComponent'
import DestinationEventCard from './DestinationEventCardComponent'
import RegionEventCard from './RegionEventCardComponent'

import { mapState } from 'vuex'
// import {createNamespacedHelpers} from 'vuex'
// const { mapState } = createNamespacedHelpers('student');

export default {
    components: {
        SubjectEventCard,
        DestinationEventCard,
        RegionEventCard
    },
    props: {
        user: Object,
    },
    data: function(){
        return {
            // id: this.$route.params.id
        }
    },
    mounted(){
        this.$store.dispatch('student/recommendSubjectEvents');
        this.$store.dispatch('student/recommendDestinationEvents');
         this.$store.dispatch('student/recommendRegionEvents');
    },
    created(){
        
    },
    computed: {
        ...mapState('student', [
            'recommendedSubjectEvents',
            'recommendedDestinationEvents',
            'recommendedRegionEvents'
        ])
    },
    methods: {
       
    }
}
</script>

<style>

</style>