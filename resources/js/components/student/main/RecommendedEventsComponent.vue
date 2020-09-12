<template>
<v-container>
    <h2 class="grey--text text--darken-2">Your subject insterests</h2>
    <eventcard-component
        v-bind:events="recommendedSubjectEvents"
        v-bind:user="user"
        class="mb-10"
    ></eventcard-component>
    <h2 class="grey--text text--darken-2">From countries of your interest</h2>
    <eventcard-component
        v-bind:events="recommendedDestinationEvents"
        v-bind:user="user"
        class="mb-10"
    ></eventcard-component>
    <h2 class="grey--text text--darken-2">Focus on your region</h2>
    <eventcard-component
        v-bind:events="recommendedRegionEvents"
        v-bind:user="user"
        class="mb-10"
    ></eventcard-component>
</v-container>
</template>

<script>
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
    },
    data: function(){
        return {
            id: this.$route.params.id
        }
    },
    mounted(){
        this.$store.dispatch('student/recommendSubjectEvents', {
            id: this.id
        });
        this.$store.dispatch('student/recommendDestinationEvents', {
            id: this.id
        });
         this.$store.dispatch('student/recommendRegionEvents', {
            id: this.id
        });
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