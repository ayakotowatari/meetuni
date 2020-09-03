<template>
<div>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="8">
                <h2 class="grey--text text--darken-1">Step 2</h2>
            </v-col>
        </v-row>
        <v-form class="mb-6" :disabled="hideSelect" ref="form">
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
                <v-col col="12" sm="12" md="1" offset-md="7">
                    <v-btn 
                    :disabled = "isSubmitted"
                    depressed 
                    block 
                    color="primary" 
                    class="mx-0" 
                    :loading="loading"
                    @click="submit"
                    >Save
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
        hideSelect: Boolean
    },
    data: () => ({
        // hideSelect: true,
        loading: false,
        isSubmitted: false,
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
                this.isSubmitted = true;

                axios
                .post("/inst/create-selects", {
                    regions: this.selectedRegions,
                    levels: this.selectedLevels,
                    subjects: this.selectedSubjects
                })
                 .then(response => {
                    this.loading = false;
                    this.$emit('selectsAdded');
                    // this.regions='';
                    // this.levels='';
                    // this.subjects='';
                })
                .catch(error => 
                    this.allerror = error.response.data.errors
                )
            }
        }
    },
    computed: {
        ...mapState([
          'regions',
          'levels',
          'subjects'
        ])
    }
}
</script>

<style>

</style>