<template>
  <v-container>
    <h1 class="subheading grey--text">Create Events</h1>
    <v-container>
      <v-form ref="form">
            <v-row justify="center">
              <v-col cols="12" sm="12" md="8">
                <v-text-field 
                    label="Event Title" 
                    prepend-icon="mdi-subtitles-outline"
                    v-model="title" 
                    :rules="titleRules" 
                    required
                ></v-text-field>
              </v-col>
            </v-row>
            <v-row justify="center">
              <v-col cols="12" sm="12" md="4">
                <v-menu
                    ref="menu"
                    v-model="menu"
                    :close-on-content-click="false"
                    :return-value.sync="date"
                    transition="scale-transition"
                    offset-y
                    min-width="290px"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                        v-model="date"
                        label="Date"
                        prepend-icon="mdi-calendar-month-outline"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                        :rules="dateRules"
                        required
                    ></v-text-field>
                  </template>
                  <v-date-picker v-model="date" no-title scrollable>
                    <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="menu = false">Cancel</v-btn>
                    <v-btn text color="primary" @click="$refs.menu.save(date)">OK</v-btn>
                  </v-date-picker>
                </v-menu>
              </v-col>
              <v-col cols="12" sm="12" md="4">
                <v-select
                    v-model="timezone"
                    :items="['0-17', '18-29', '30-54', '54+']"
                    label="Timezone"
                    :rules="timezoneRules" 
                    prepend-icon="mdi-map-marker-radius-outline"
                    hint="What is your timezone?"
                    persistent-hint
                    required
                ></v-select>
                    <!-- <v-select
                        v-model="timezone"
                        :items="['0-17', '18-29', '30-54', '54+']"
                        label="Timezone"
                        :rules="timezoneRules" 
                        chips
                        prepend-icon="mdi-map-marker-radius-outline"
                        hint="What is your timezone?"
                        persistent-hint
                    ></v-select> -->
              </v-col>
            </v-row>
            <v-row justify="center">
              <v-col cols="12" sm="12" md="4">
                <v-menu
                    ref="menu2"
                    v-model="menu2"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    :return-value.sync="time"
                    transition="scale-transition"
                    offset-y
                    max-width="290px"
                    min-width="290px"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                        v-model="time"
                        label="Start Time"
                        prepend-icon="mdi-clock-outline"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                        required
                    ></v-text-field>
                  </template>
                  <v-time-picker
                      v-if="menu2"
                      v-model="time"
                      full-width
                      :allowed-minutes="allowedSteps"
                      :max="time2"
                      @click:minute="$refs.menu2.save(time)"
                  ></v-time-picker>
                </v-menu>
              </v-col>
              <v-col cols="12" sm="12" md="4">
                <v-menu
                    ref="menu3"
                    v-model="menu3"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    :return-value.sync="time"
                    transition="scale-transition"
                    offset-y
                    max-width="290px"
                    min-width="290px"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                        v-model="time2"
                        label="End Time"
                        prepend-icon="mdi-clock-outline"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                    ></v-text-field>
                  </template>
                  <v-time-picker
                      v-if="menu3"
                      v-model="time2"
                      full-width
                      :allowed-minutes="allowedSteps"
                      :min="time"
                      @click:minute="$refs.menu3.save(time)"
                  ></v-time-picker>
                </v-menu>
              </v-col>
            </v-row>
            <v-row justify="center">
              <v-col col="12" sm="12" md="8">
                <v-select
                    v-model="selectedRegions"
                    :items="regions"
                    item-text="region"
                    item-value='id'
                    label="Regions"
                    :rules="regionRules" 
                    multiple
                    chips
                    prepend-icon="mdi-globe-model"
                    hint="What are target regions?"
                    persistent-hint
                    required
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
                    :rules="levelRules" 
                    multiple
                    chips
                    prepend-icon="mdi-layers-triple-outline"
                    hint="What are target levels?"
                    persistent-hint
                    required
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
                    :rules="subjectRules" 
                    multiple
                    chips
                    prepend-icon="mdi-school-outline"
                    hint="What are target subject areas?"
                    persistent-hint
                    required
                ></v-select>
              </v-col>
            </v-row>
            <v-row justify="center">
              <v-col cols="12" sm="12" md="8">
                <v-textarea
                    v-model="description"
                    counter
                    label="Event Description"
                    prepend-icon="mdi-pencil-outline"
                    :rules="textareaRules"
                ></v-textarea>
              </v-col>
            </v-row>
            <v-row justify="center">
              <v-col col="12" sm="12" md="8">
                <v-file-input
                    :rules="imageRules"
                    accept="image/png, image/jpeg, image/bmp"
                    placeholder="Pick an image"
                    prepend-icon="mdi-camera-outline"
                    label="Event Image"
                ></v-file-input>
                {{ errors.getErrors(img) }}
              </v-col>
            </v-row>
              <!-- <v-col cols="12">
                <v-text-field label="Email*" required></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field label="Password*" type="password" required></v-text-field>
              </v-col>
              <v-col cols="12" sm="6">
                <v-autocomplete
                  :items="['Skiing', 'Ice hockey', 'Soccer', 'Basketball', 'Hockey', 'Reading', 'Writing', 'Coding', 'Basejump']"
                  label="Interests"
                  multiple
                ></v-autocomplete>
              </v-col> -->              
            <v-row justify="center">
             <v-col col="12" sm="12" md="8">
                  <v-btn 
                    :disabled="!valid"
                    depressed 
                    block 
                    color="primary" 
                    class="mx-0 mt-3" 
                    @click.prevent="submit"
                  >Add project
                  </v-btn>
             </v-col>
            </v-row>
          </v-form>
      </v-container>
  </v-container>
</template>

<script>
// import {format, parseISO } from 'date-fns'
import moment from 'moment'

class Errors {

  constructor(){
    this.errors = {};
  }
  getErrors(field){
    if(this.errors[field]){
      return this.errors[field][0];
    }
  }
  record(errors){
    this.errors = errors.errors;
  }
}

export default {
  props: {
    levels: Array,
    subjects: Array,
    regions: Array,
  },
  data: () => ({
    valid: true,
    loading: false,
    title: '',
    titleRules: [
      v => !!v || 'Event title is required',
    ],
    date: null,
    dateRules: [
      v => !!v || 'Date is required',
    ],
    timezone: '',
    timezoneRules: [
      v => !!v || 'Timezone is required',
    ],
    menu: false,
    time: null,
    menu2: false,
    timeRules: [
      v => !!v || 'Time is required',
    ],
    menu3: false,
    time2: null,
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
    description: '',
    textareaRules: [v => v.length <= 300 || 'Max 300 characters'],
    file: [],
    imageRules: [
        value => !value || value.size < 2000000 || 'Image size should be less than 2 MB.',
    ],
    errors: new Errors()
  }),
  methods: {
    validate(){
      this.$refs.form.validate()
    },
    allowedSteps: m => m % 10 === 0,
    submit(){
      if(this.$refs.form.validate()){
          this.loading = true;
          axios
            .post("/inst/create-events/store", {
                title: this.title,
                date: this.date,
                timezone: this.timezone,
                start_time:this.time,
                end_time:this.time2,
                regions:this.selectedRegions,
                levels:this.selectedLevels,
                subjects:this.selectedSubjects,
                description:this.description
            })
            .then(response => {
                this.loading = false;
                this.title='';
                this.date='';
                this.timezone='';
                this.time='';
                this.time2='';
                this.selectedRegions="";
                this.selectedLevels="";
                this.selectedSubjects="";
                this.description=''
            })
            // .catch(error => 
            //     this.allerror = error.response.data.errors
            // );
            .catch(error => 
                    this.errors.record(error.response.data)
                )
        }
      }
  },
  computed: {
    //change date format
    // formattedTime(){
    //   return this.time ? moment(this.time).format('hh:mm') : ''
    // },
    // formattedTimeTwo(){
    //   return this.time2 ? moment(this.time2).format('HH:mm:ss') : ''
    // },
    // formattedDate(){
    //   return this.date ? format(parseISO(this.date), 'EEE, MMM do, yyyy, zzz') : ''
    // },
    // formattedTime(){
    //   return this.time ? format(parseISO(this.time), 'h:mm bbb') : ''
    // },
    // allowedStep: m => m % 10 === 0,

  }

}
</script>

<style>

</style>