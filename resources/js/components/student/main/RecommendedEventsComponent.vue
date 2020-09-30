<template>
    <div>
        <v-container v-if="user !== null">
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
        <v-container v-if="user == null">
            <v-row justify="center">
                <v-col cols="12" xs="12" md="6">
                    <h2 class="grey--text mt-8">Sign in to help us find suitable events for you.</h2> 
                </v-col>
            </v-row>
             <v-row justify="center">
                <v-col cols="12" xs="12" md="6">
                    <v-btn 
                        color="info darken-2" 
                        outlined
                        @click="toLoginPage"
                    >Sign in</v-btn>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
import SubjectEventCard from './SubjectEventCardComponent'
import DestinationEventCard from './DestinationEventCardComponent'
import RegionEventCard from './RegionEventCardComponent'
import Login from '../auth/LoginComponent'

import { mapState, mapMutations } from 'vuex'
// import {createNamespacedHelpers} from 'vuex'
// const { mapState } = createNamespacedHelpers('student');

export default {
    components: {
        SubjectEventCard,
        DestinationEventCard,
        RegionEventCard,
        Login
    },
    props: {
        user: Object,
        isLoggedIn: Boolean,
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
            'recommendedRegionEvents',
        ])
    },
    methods: {
        ...mapMutations('student', {

        }),
        toLoginPage(){
            this.$router.push({name: 'student-login'});
        }
       
    }
}
</script>

<style>

</style>