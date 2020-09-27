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
                    @click.stop="startEditing"
                >Edit</v-btn>
            </v-col>
        </v-row>
        <div v-if="isEditing">
            <v-row justify="center">
                <v-col col="12" sm="12" md="6">
                    <v-card outlined height="100px" class="pa-2 mb-4">
                        <v-chip-group 
                            v-model="selectedDestinations" 
                            column 
                            active-class="primary--text text--accent-4"
                            multiple
                            mandatory
                        >
                            <v-chip v-for="destination in destinationList" :key="destination.country" :value="`${destination.id}`">{{ destination.country }}</v-chip>
                        </v-chip-group>
                    </v-card>
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col col="12" sm="12" md="6" class="py-0">
                    <v-btn 
                        depressed 
                        color="primary" 
                        @click="save"
                    >Save
                    </v-btn>
                    <v-btn 
                        color="primary" 
                        outlined
                        class="ml-4" 
                        @click="hasFinishedEditing"
                    >Cancel
                    </v-btn>
                </v-col>
            </v-row>
        </div>


    </div>
</template>

<script>
import { mapState, mapMutations, mapActions } from 'vuex'

export default {
    props: {
        user: Object
    },
    data: function(){
        return{
            selectedDestinations: [],        }
    },
    mounted(){
        this.$store.dispatch('student/fetchStudentPreference')
        this.$store.dispatch('student/fetchDestinationList')
        this.$store.dispatch('student/fetchLevelList')
        this.$store.dispatch('student/fetchSubjectList')
    },
    computed: {
        ...mapState('student', [
            'isEditing',
            'preference',
            'destinationList',
            'levelList',
            'subjectList',
            'allerror'
        ])
    },
    methods: {
        ...mapMutations('student', {
            startEditing: 'setIsEditing',
            hasFinishedEditing: 'hasFinishedEditing'
        }),
        ...mapActions('student', [
            'updateDestinations'
        ]),
        save(){

            this.updateDestinations({
                destinations: this.selectedDestinations,
            })
            console.log('check');
            console.log(this.selectedDestinations);
        }
    }

}
</script>

<style>

</style>