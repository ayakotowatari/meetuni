<template>
    <div>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="6">
                <h2 class="grey--text text--darken-1">Levels</h2>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="4">
                <v-chip v-for="level in preference.levels" :key="level.level" class="ma-2">{{ level.level }}</v-chip>
            </v-col>
            <v-col cols="12" sm="12" md="1" offset-md="1">
                <v-btn
                    v-if="!isEditingForLevels"
                    color="primary"
                    outlined
                    @click.stop="setIsEditing"
                >Edit</v-btn>
            </v-col>
        </v-row>
        <div v-if="isEditingForLevels">
            <v-row justify="center">
                <v-col cols="12" sm="12" md="6">
                    <v-card outlined height="100%" class="pa-2 mb-4">
                        <v-chip-group 
                            v-model="selectedLevels" 
                            column 
                            active-class="primary--text text--accent-4"
                            multiple
                            mandatory
                        >
                            <v-chip v-for="level in levelList" :key="level.level" :value="`${level.id}`">{{ level.level }}</v-chip>
                        </v-chip-group>
                    </v-card>
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col cols="12" sm="12" md="6" class="py-0">
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
            selectedLevels: [],        }
    },
    mounted(){
        this.$store.dispatch('student/fetchStudentPreference')
        this.$store.dispatch('student/fetchLevelList')
    },
    computed: {
        ...mapState('student', [
            'isEditingForLevels',
            'preference',
            'levelList',
            'allerror'
        ])
    },
    methods: {
        ...mapMutations('student', {
            setIsEditing: 'setIsEditingForLevels',
            hasFinishedEditing: 'hasFinishedEditingForLevels'
        }),
        ...mapActions('student', [
            'updateLevels'
        ]),
        save(){

            this.updateLevels({
                levels: this.selectedLevels,
            })
            console.log('check');
            console.log(this.selectedLevels);
        }
    }

}
</script>

<style>

</style>