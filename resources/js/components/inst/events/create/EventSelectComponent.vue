<template>
    <div v-if="hideSelects == false">
        <v-row justify="center">
            <v-col cols="12" sm="12" md="8">
                <h2 class="grey--text text--darken-1">Step 2</h2>
            </v-col>
        </v-row>
        <v-form class="mb-6" :disabled="hideSelects" ref="form">
        <v-row justify="center">
                <v-col col="12" sm="12" md="8">
                    <v-select
                        v-model="selectedRegions"
                        :items="regions"
                        item-text="region"
                        item-value='id'
                        label="Regions"
                        outlined
                        :rules="regionRules" 
                        multiple
                        chips
                        prepend-icon="mdi-globe-model"
                        hint="What are target regions?"
                        persistent-hint
                        required
                        :error="allerror.regions"
                        :error-messages="allerror.regions"
                    ></v-select>
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col col="12" sm="12" md="8">
                    <v-select
                        v-model="selectedLevels"
                        :items="levels"
                        item-text="level"
                        item-value="id"
                        label="Levels"
                        outlined
                        :rules="levelRules" 
                        multiple
                        chips
                        prepend-icon="mdi-layers-triple-outline"
                        hint="What are target levels?"
                        persistent-hint
                        required
                        :error="allerror.levels"
                        :error-messages="allerror.levels"
                    ></v-select>
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col col="12" sm="12" md="8">
                    <v-select
                        v-model="selectedSubjects"
                        :items="subjects"
                        item-text="subject"
                        item-value="id"
                        label="Subject Areas"
                        outlined
                        :rules="subjectRules" 
                        multiple
                        chips
                        prepend-icon="mdi-school-outline"
                        hint="What are target subject areas?"
                        persistent-hint
                        required
                        :error="allerror.subjects"
                        :error-messages="allerror.subjects"
                    ></v-select>
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col col="12" sm="12" md="8">
                    <v-btn 
                        :disabled = "selectsAreSubmitted"
                        depressed 
                        class="mr-3"
                        color="primary" 
                        @click="submit"
                        :loading="loading"
                    >Save
                    </v-btn>
                     <v-btn 
                        :disabled = "!selectsAreSubmitted"
                        depressed 
                        outlined
                        color="primary" 
                        @click="next"
                        :loading="loading"
                    >Next
                    </v-btn>
                </v-col>
            </v-row>
        </v-form>
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
    props: {
        hideSelects: Boolean
    },
    data: () => ({
        // hideSelect: true,
        selectsAreSubmitted: false,
        loading: false,
        selectedRegions: [],
        regionRules: [
        v => !!v || 'Region is required',
        ],
        selectedLevels: [],
        levelRules: [
        v => !!v || 'Level is required',
        ],
        selectedSubjects: [],
        subjectRules: [
        v => !!v || 'Subject Area is required',
        ],
        allerror: [],
    }),
    mounted(){
      this.$store.dispatch('fetchRegions');
      this.$store.dispatch('fetchLevels');
      this.$store.dispatch('fetchSubjects')
    },
    computed: {
        ...mapState([
          'regions',
          'levels',
          'subjects'
        ])
    },
    methods: {
        // validate(){
        //     if(
        //         this.selectedRegions != '' && 
        //         this.selectedLevels != '' && 
        //         this.selectedSubjects != '' 
        //     ){
        //         return true
        //     }else{
        //         return false
        //     }
        // },
       
        submit(){
            if(this.$refs.form.validate()){
                this.loading = true;

                axios
                .post("/inst/create-selects", {
                    regions: this.selectedRegions,
                    levels: this.selectedLevels,
                    subjects: this.selectedSubjects
                })
                 .then(response => {
                    this.loading = false;
                    this.selectsAreSubmitted = true;
                    // this.regions='';
                    // this.levels='';
                    // this.subjects='';
                })
                .catch(error => {
                    this.allerror = error.response.data.errors
                })
            }
        },
        next(){
                this.$emit('openThirdEventForm');
                this.$emit('closeSecondEventForm');
        }
    },
}
</script>

<style>

</style>