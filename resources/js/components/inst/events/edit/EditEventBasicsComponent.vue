<template>
  <v-form class="mb-6" v-model="valid">
       <v-row justify="center">
            <v-col cols="12" sm="12" md="8">
                <v-text-field 
                    label="Event Title" 
                    outlined
                    prepend-icon="mdi-subtitles-outline"
                    v-model="title" 
                    :rules="titleRules" 
                    required
                    :error="allerror.title"
                    :error-messages="allerror.title"
                ></v-text-field>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="8">
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
                        outlined
                        prepend-icon="mdi-calendar-month-outline"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                        :rules="dateRules"
                        required
                        :error="allerror.date"
                        :error-messages="allerror.date"
                    ></v-text-field>
                    </template>
                    <v-date-picker v-model="date" no-title scrollable>
                    <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="menu = false">Cancel</v-btn>
                    <v-btn text color="primary" @click="$refs.menu.save(date)">OK</v-btn>
                    </v-date-picker>
                </v-menu>
            </v-col>
        </v-row>
        <v-row justify="center" class="mb-7">
            <v-col cols="12" sm="12" md="8">
                <v-select
                    v-model="timezone"
                    :items="['0-17', '18-29', '30-54', '54+']"
                    label="Timezone"
                    outlined
                    :rules="timezoneRules" 
                    prepend-icon="mdi-map-marker-radius-outline"
                    hint="What is your timezone?"
                    persistent-hint
                    required
                    :error="allerror.timezone"
                    :error-messages="allerror.timezone"
                ></v-select>
                <div class="selected">
                    <span>Currently selected: </span>
                    <v-chip class="ma-2">{{ timezone }}</v-chip>
                </div>
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
                        outlined
                        prepend-icon="mdi-clock-outline"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                        required
                        :error="allerror.start_time"
                        :error-messages="allerror.start_time"
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
                        outlined
                        prepend-icon="mdi-clock-outline"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                        required
                        :error="allerror.end_time"
                        :error-messages="allerror.end_time"
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
            <v-col col="12" sm="12" md="1" offset-md="7">
                <v-btn 
                :disabled="!valid"
                depressed 
                block 
                color="primary" 
                class="mx-0" 
                @click="submit"
                :loading="loading"
                >Save
                </v-btn>
            </v-col>
        </v-row>
     </v-form>
</template>

<script>
import moment from 'moment'

export default {
    props: {
        id: Number,
        title: String,
        date: String,
        timezone: String,
        time: String,
        time2: String,
        levels: Array,
        subjects: Array,
        regions: Array,
    },
    data: () => ({
        valid: true,
        loading: false,
        titleRules: [
        v => !!v || 'Event title is required',
        ],
        dateRules: [
        v => !!v || 'Date is required',
        ],
        timezoneRules: [
        v => !!v || 'Timezone is required',
        ],
        menu: false,
        menu2: false,
        timeRules: [
        v => !!v || 'Time is required',
        ],
        menu3: false,
        allerror: []
    }),
    methods: {
        validate(){
            if(
                this.title != '' && 
                this.date != '' && 
                this.timezone != '' &&
                this.time != '' &&
                this.time2 != ''
            ){
                return true
            }else{
                return false
            }
        },
        // validate(){
        //     this.$refs.form.validate()
        // },
        allowedSteps: m => m % 10 === 0,
        
        submit(){
            if(this.valid=true){
                this.loading = true;

                axios
                .post("/inst/update-basics", {
                    id: this.id,
                    title: this.title,
                    date: this.date,
                    timezone: this.timezone,
                    start_time: this.time,
                    end_time: this.time2
                })
                .then(response => {
                    this.loading = false;
                    // this.$emit('basicsAdded');
                })
                .catch(error => 
                    this.allerror = error.response.data.errors
                )
            }
        }
    }
}
</script>

<style>
.selected{
    margin-left: 36px;
}
</style>