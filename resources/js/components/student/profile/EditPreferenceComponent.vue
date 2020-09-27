<template>
    <div>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="6">
                <h2 class="grey--text text--darken-1">Destinations</h2>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="4">
                <v-chip v-for="destination in preference.destinations" :key="destination.destination" class="ma-2">{{ destination.country }}</v-chip>
            </v-col>
            <v-col cols="12" sm="12" md="1" offset-md="1">
                <v-btn
                    v-if="!isEditing"
                    color="primary"
                    outlined
                    @click="setIsEditing"
                >Edit</v-btn>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col col="12" sm="12" md="8">
                 <v-chip-group 
                    v-model="selectedDestinations" 
                    column 
                    active-class="primary--text text--accent-4"
                    multiple
                    mandatory
                >
                    <v-chip v-for="destination in destinationList" :key="destination.country" :value="`${destination.id}`">{{ destination.country }}</v-chip>
                </v-chip-group>
            </v-col>
        </v-row>


    </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
    props: {
        user: Object
    },
    mounted(){
        this.$store.dispatch('student/fetchStudentPreference')
        this.$store.dispatch('student/fetchDestinationList')
        this.$store.dispatch('student/fetchLevelList')
        this.$store.dispatch('student/fetchSubjectList')
    },
    computed: {
        ...mapState('student', [
            'preference',
            'destinaionList',
            'levelList',
            'subjectList'
        ])
    },

}
</script>

<style>

</style>