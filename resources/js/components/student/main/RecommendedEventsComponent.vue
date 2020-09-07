<template>
<v-container>
    <h2 class="grey--text text--darken-2">Your subject insterests</h2>
    <subjectrecommend-component
        v-bind:events="recommendedSubjectEvents"
        v-bind:user="user"
    ></subjectrecommend-component>
    <h2 class="grey--text text--darken-2">From countries of your interest</h2>
    <destinationrecommend-component
        v-bind:events="recommendedDestinationEvents"
        v-bind:user="user"
    ></destinationrecommend-component>
    <h2 class="grey--text text--darken-2">Focus on your region</h2>
    <regionrecommend-component
        v-bind:events="recommendedRegionEvents"
        v-bind:user="user"
    ></regionrecommend-component>
</v-container>
</template>

<script>
import SubjectRecommend from './SubjectRecommendComponent'
import DestinationRecommend from './DestinationRecommendComponent'
import RegionRecommend from './RegionRecommendComponent'

// import { mapState } from 'vuex'
import {createNamespacedHelpers} from 'vuex'
const { mapState } = createNamespacedHelpers('student');

export default {
    components: {
        SubjectRecommend,
        DestinationRecommend,
        RegionRecommend,
    },
    props: {
        user: Array,
    },
    data: () => ({

    }),
    mounted(){
        this.$store.dispatch('student/recommendSubjectEvents', {
            id: this.user.id
        });
        this.$store.dispatch('student/recommendDestinationEvents', {
            id: this.user.id
        });
         this.$store.dispatch('student/recommendRegionEvents', {
            id: this.user.id
        });
    },
    created(){
        
    },
    computed: {
        ...mapState([
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