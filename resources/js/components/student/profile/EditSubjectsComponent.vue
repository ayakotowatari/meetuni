<template>
    <div>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="6">
                <h2 class="grey--text text--darken-1">Subjects</h2>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="4">
                <v-chip v-for="subject in preference.subjects" :key="subject.subject" class="ma-2">{{ subject.subject }}</v-chip>
            </v-col>
            <v-col cols="12" sm="12" md="1" offset-md="1">
                <v-btn
                    v-if="!isEditingForSubjects"
                    color="primary"
                    outlined
                    @click.stop="setIsEditing"
                >Edit</v-btn>
            </v-col>
        </v-row>
        <div v-if="isEditingForSubjects">
            <v-row justify="center">
                <v-col col="12" sm="12" md="6">
                    <v-card outlined height="300px" class="pa-2 mb-4">
                        <v-chip-group 
                            v-model="selectedSubjects" 
                            column 
                            active-class="primary--text text--accent-4"
                            multiple
                            mandatory
                        >
                            <v-chip v-for="subject in subjectList" :key="subject.subject" :value="`${subject.id}`">{{ subject.subject }}</v-chip>
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
            selectedSubjects: [],        }
    },
    mounted(){
        this.$store.dispatch('student/fetchStudentPreference')
        this.$store.dispatch('student/fetchSubjectList')
    },
    computed: {
        ...mapState('student', [
            'isEditingForSubjects',
            'preference',
            'subjectList',
            'allerror'
        ])
    },
    methods: {
        ...mapMutations('student', {
            setIsEditing: 'setIsEditingForSubjects',
            hasFinishedEditing: 'hasFinishedEditingForSubjects'
        }),
        ...mapActions('student', [
            'updateSubjects'
        ]),
        save(){

            this.updateSubjects({
                subjects: this.selectedSubjects,
            })
           
        }
    }

}
</script>

<style>

</style>