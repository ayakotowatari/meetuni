<template>
    <div>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="6">
                <h2 class="grey--text text--darken-1">When are you planning to start study abroad?</h2>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="4">
                <h4>{{ year.year }}</h4>
            </v-col>
            <v-col cols="12" sm="12" md="1" offset-md="1">
                <v-btn
                    v-if="!isEditingForYear"
                    color="primary"
                    outlined
                    @click="setIsEditing"
                >Edit</v-btn>
            </v-col>
        </v-row>
        <v-form v-if="isEditingForYear" ref="form">
            <v-row justify="center">
                <v-col cols="12" sm="12" md="6">
                    <v-select
                        v-model="selectedYear"
                        :items="years"
                        item-text="year"
                        item-value='id'
                        label="Year"
                        outlined
                        :rules="yearRules" 
                        required
                        :error="allerror.year"
                        :error-messages="allerror.year"
                    >
                    </v-select>
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
        </v-form>
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
            yearRules: [
                v => !!v || 'Year is required',
            ],
        }
    },
    mounted(){
        this.$store.dispatch('student/fetchYearsList');
        this.$store.dispatch('student/fetchStudentYear');
    },
    computed: {
        ...mapState('student', [
            'year',
            'years',
            'isEditingForYear',
            'loading',
            'allerror'
        ]),
        // selectedYear: {
        //     get(){
        //         return this.year.year
        //     },
        //     set (value) {
        //         console.log('check');
        //         console.log(value);
        //         this.$store.commit('student/updateYearId', value)
        //     }
        // },
    },
    methods: {
        ...mapMutations('student', {
            setIsEditing: 'setIsEditingForYear',
            hasFinishedEditing: 'hasFinishedEditingForYear'
        }),
        ...mapActions('student', [
            'updateYear',
        ]),
        save(){
            if(this.$refs.form.validate()){

                this.updateYear({
                    year_id: this.selectedYear
                })
            }
        }
    }

}
</script>

<style>

</style>