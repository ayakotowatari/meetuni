<template>
    <div class="mb-6">
      <v-row justify="center">
          <v-col col="12" sm="12" md="8">
               <h3 class="py-0">Regions</h3>
          </v-col>  
      </v-row>
      <v-row justify="center">
          <v-col col="12" sm="12" md="8" class="py-0">
               <span>Currently selected: </span>
               <v-chip v-for="eventRegion in eventRegions" :key="eventRegion.region" class="ma-2">{{ eventRegion.region }}</v-chip>
          </v-col>
      </v-row>
      <v-form>
        <v-row justify="center">
            <v-col col="12" sm="12" md="8" class="py-0">
                <v-btn @click="hideRegions = !hideRegions" color="primary" outlined class="py-0">Change</v-btn>
                <v-btn v-if="!hideRegions" @click="updateRegions" class="ml-4" color="primary" outlined>Save</v-btn>
            </v-col>
        </v-row>
        <v-row justify="center">
                <v-col col="12" sm="12" md="8">
                    <v-select
                        v-if="!hideRegions"
                        v-model="editedRegions"
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
        </v-form>
         <v-row justify="center">
          <v-col col="12" sm="12" md="8">
               <h3 class="py-0">Levels</h3>
          </v-col>  
        </v-row>
        <v-row justify="center">
            <v-col col="12" sm="12" md="8" class="py-0">
                    <span>Currently selected: </span>
                    <v-chip v-for="eventLevel in eventLevels" :key="eventLevel.level" class="ma-2">{{ eventLevel.level }}</v-chip>
            </v-col>
        </v-row>
        <v-row justify="center">
          <v-col col="12" sm="12" md="8" class="py-0">
              <v-btn @click="hideLevels = !hideLevels" color="primary" outlined>Change</v-btn>
              <v-btn v-if="!hideLevels" @click="updateLevels" class="ml-4" color="primary" outlined>Save</v-btn>
          </v-col>
        </v-row>
        <v-row justify="center">
            <v-col col="12" sm="12" md="8">
                <v-select
                    v-if="!hideLevels"
                    v-model="editedLevels"
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
               <h3 class="py-0">Subjects</h3>
          </v-col>  
        </v-row>
        <v-row justify="center">
            <v-col col="12" sm="12" md="8" class="py-0">
                <span>Currently selected: </span>
                <v-chip v-for="eventSubject in eventSubjects" :key="eventSubject.subject" class="ma-2">{{ eventSubject.subject }}</v-chip>
            </v-col>
        </v-row>
        <v-row justify="center">
          <v-col col="12" sm="12" md="8" class="py-0">
              <v-btn @click="hideSubjects = !hideSubjects" color="primary" outlined>Change</v-btn>
              <v-btn v-if="!hideSubjects" @click="updateSubjects" class="ml-4" color="primary" outlined>Save</v-btn>
          </v-col>
        </v-row>
        <v-row justify="center">
            <v-col col="12" sm="12" md="8">
                <v-select
                    v-if="!hideSubjects"
                    v-model="editedSubjects"
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
        <!-- <v-row justify="center">
            <v-col col="12" sm="12" md="1" offset-md="7">
                <v-btn 
                :disabled="!valid"
                depressed 
                block 
                color="primary" 
                class="mx-0" 
                :loading="loading"
                @click="submit"
                >Save
                </v-btn>
            </v-col>
        </v-row> -->
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
    props: {
        id: String
    },
    data: () => ({
        loading: false,
        hideRegions: true,
        hideLevels: true,
        hideSubjects: true,
        editedRegions:'',
        regionRules: [
        v => !!v || 'Region is required',
        ],
        editedLevels:'',
        levelRules: [
        v => !!v || 'Level is required',
        ],
        editedSubjects:'',
        subjectRules: [
        v => !!v || 'Subject Area is required',
        ],
        allerror: [],
    }),
    mounted(){
        this.$store.dispatch('fetchRegions');
        this.$store.dispatch('fetchLevels');
        this.$store.dispatch('fetchSubjects');
    },
    methods: {
        updateRegions(){

            if(this.valid=true){
                this.loading = true;

                axios
                .post("/inst/update-regions", {
                    id: this.id,
                    regions: this.editedRegions,
                })
                .then(response => {
                    this.loading = false;
                    // this.$emit('selectsAdded');
                })
                .catch(error => 
                    this.allerror = error.response.data.errors
                )
            }
        },
        updateLevels(){

            if(this.valid=true){
                this.loading = true;

                axios
                .post("/inst/update-levels", {
                    id: this.id,
                    levels: this.editedLevels,
                })
                .then(response => {
                    this.loading = false;
                    // this.$emit('selectsAdded');
                })
                .catch(error => 
                    this.allerror = error.response.data.errors
                )
            }
        },
        updateSubjects(){

            if(this.valid=true){
                this.loading = true;

                axios
                .post("/inst/update-subjects", {
                    id: this.id,
                    subjects: this.editedSubjects,
                })
                .then(response => {
                    this.loading = false;
                    // this.$emit('selectsAdded');
                })
                .catch(error => 
                    this.allerror = error.response.data.errors
                )
            }
        },
    },
    computed: {
        ...mapState ([
            'regions',
            'levels',
            'subjects', 
            'eventRegions',
            'eventLevels',
            'eventSubjects'
        ])
    }
}
</script>

<style>

</style>