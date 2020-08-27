<template>
<div>
  <v-snackbar v-model="snackbar" :timeout="4000" bottom>
          <span>A new event has been added.</span>
          <template v-slot:action="{ attrs }">
              <v-btn 
                depressed 
                text 
                class="white--text" 
                v-bind="attrs" 
                @click="snackbar = false"
              >Close
              </v-btn>
          </template>
  </v-snackbar>

  <h1 class="grey--text">Create Events</h1>
  <v-container>
      <eventbasics-component @basicsAdded = "hide = false"></eventbasics-component>
      <v-form class="mb-6" :disabled="hide" v-model="valid">
        <eventselect-component 
          v-bind:regions="regions"
          v-bind:levels="levels"
          v-bind:subjects="subjects"
          @selectsAdded = "hide = false"
        ></eventselect-component>
      </v-form>
      <v-form class="mb-6" :disabled="hide" v-model="valid">
        <eventfile-component
          @eventAdded = "snackbar = true"
        ></eventfile-component>
      </v-form>
  </v-container>
</div>
</template>

<script>
import EventBasics from './EventBasicsComponent'
import EventSelect from './EventSelectComponent'
import EventFile from './EventFileComponent'

export default {
  components: { 
    EventBasics,
    EventSelect,
    EventFile
  },
  props: {
    levels: Array,
    subjects: Array,
    regions: Array,
  },
  data: () => ({
    valid: true,
    loading: false,
    hide: true,
    allerror: [],
    snackbar: false
  }),
  methods: {
    validate(){
      this.$refs.form.validate()
    },
    submit(){
      let testregions = this.selectedRegions;
      console.log(testregions);
      
      if(this.$refs.form.validate()){
          this.loading = true;

          let data = new FormData();
          data.append("image", this.files);
          data.append("title", this.title);
          data.append("date", this.date);
          data.append("timezone", this.timezone);
          data.append("start_time", this.time);
          data.append("end_time", this.time2);
          data.append("regions", this.selectedRegions);
          data.append("levels", this.selectedLevels);
          data.append("subjects", this.selectedSubjcts);
          data.append("description", this.description);

          let config = {headers: {'Content-Type': 'multipart/form-data'}};
         
          axios
            .post("/inst/create-events/store", data, config)
            .then(response => {
                this.loading = false;
                this.snackbar = true;
                this.title='';
                this.date='';
                this.timezone='';
                this.time='';
                this.time2='';
                this.selectedRegions="";
                this.selectedLevels="";
                this.selectedSubjects="";
                this.description='';
                this.file='';
            })
            // .catch(error => 
            //     this.allerror = error.response.data.errors
            // );
            .catch(error => 
                    this.allerror = error.response.data.errors
                )
        }
      }
  },
  computed: {
   
  }

}
</script>

<style>

</style>