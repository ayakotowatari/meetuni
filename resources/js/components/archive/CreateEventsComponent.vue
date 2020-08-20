<template>
  <v-container>
    <h1 class="subheading grey--text">Create Events</h1>
    <v-container>
      <v-form ref="form">
            <v-row>
              <v-col cols="12" sm="12" md="6">
                <v-text-field 
                  label="Event Title" 
                  prepend-icon="mdi-subtitles-outline"
                  v-model="eventTitle" 
                  :rules="titleRules" 
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12" sm="12" md="6">
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
                      :value="formattedDate"
                      label="Date"
                      prepend-icon="mdi-calendar-month-outline"
                      readonly
                      v-bind="attrs"
                      v-on="on"
                      :rules="dateRules"
                    ></v-text-field>
                  </template>
                  <v-date-picker v-model="date" no-title scrollable>
                    <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="menu = false">Cancel</v-btn>
                    <v-btn text color="primary" @click="$refs.menu.save(date)">OK</v-btn>
                  </v-date-picker>
                </v-menu>
              </v-col>
              <v-col cols="12" sm="12" md="6">
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
                      label="Time"
                      prepend-icon="mdi-clock-outline"
                      readonly
                      v-bind="attrs"
                      v-on="on"
                    ></v-text-field>
                  </template>
                  <v-time-picker
                    v-if="menu2"
                    v-model="time"
                    full-width
                    @click:minute="$refs.menu2.save(time)"
                  ></v-time-picker>
                </v-menu>
              </v-col>
              <v-col cols="12" sm="12" md="6">
                <v-text-field
                  label="Legal last name*"
                  hint="example of persistent helper text"
                  persistent-hint
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field label="Email*" required></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field label="Password*" type="password" required></v-text-field>
              </v-col>
              <v-col cols="12" sm="6">
                <v-select
                  :items="['0-17', '18-29', '30-54', '54+']"
                  label="Age*"
                  required
                ></v-select>
              </v-col>
              <v-col cols="12" sm="6">
                <v-autocomplete
                  :items="['Skiing', 'Ice hockey', 'Soccer', 'Basketball', 'Hockey', 'Reading', 'Writing', 'Coding', 'Basejump']"
                  label="Interests"
                  multiple
                ></v-autocomplete>
              </v-col>
            </v-row>
          </v-form>
      </v-container>
  </v-container>
</template>

<script>
import {format, parseISO } from 'date-fns'

export default {
  data: () => ({
    valid: true,
    eventTitle: '',
    titleRules: [
      v => !!v || 'Event title is required',
    ],
    date: null,
    dateRules: [
      v => !!v || 'Date is required',
    ],
    menu: false,
    time: null,
    menu2: false,
    timeRules: [
      v => !!v || 'Time is required',
    ],
  }),
  methods: {
    validate(){
      this.$refs.form.validate()
    } 
  },
  computed: {
    // change date format
    formattedDate(){
      return this.date ? format(parseISO(this.date), 'EEE, MMM do, yyyy, zzz') : ''
    },
    // formattedTime(){
    //   return this.time ? format(parseISO(this.time), 'h:mm bbb') : ''
    // },
    // allowedStep: m => m % 10 === 0,

  }

}
</script>

<style>

</style>