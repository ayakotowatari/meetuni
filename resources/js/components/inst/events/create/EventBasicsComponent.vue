<template>
  <div>
       <v-row justify="center">
           <v-col cols="12" sm="12" md="8">
               <h2 class="grey--text text--darken-1">Step 1</h2>
           </v-col>
       </v-row>
       <v-form class="mb-6" ref="form"> 
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
                <v-col cols="12" sm="12" md="4">
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
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col cols="12" sm="12" md="4">
                    <v-menu
                        ref="menu2"
                        v-model="menu2"
                        :close-on-content-click="false"
                        :nudge-right="40"
                        :return-value.sync="start_time"
                        transition="scale-transition"
                        offset-y
                        max-width="290px"
                        min-width="290px"
                    >
                    <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                            v-model="start_time"
                            label="Start Time"
                            outlined
                            prepend-icon="mdi-clock-outline"
                            readonly
                            v-bind="attrs"
                            v-on="on"
                            :rules="timeRules" 
                            required
                            :error="allerror.start_time"
                            :error-messages="allerror.start_time"
                        ></v-text-field>
                    </template>
                    <v-time-picker
                        v-if="menu2"
                        v-model="start_time"
                        full-width
                        :allowed-minutes="allowedSteps"
                        :max="end_time"
                        @click:minute="$refs.menu2.save(start_time)"
                    ></v-time-picker>
                    </v-menu>
                </v-col>
                <v-col cols="12" sm="12" md="4">
                    <v-menu
                        ref="menu3"
                        v-model="menu3"
                        :close-on-content-click="false"
                        :nudge-right="40"
                        :return-value.sync="end_time"
                        transition="scale-transition"
                        offset-y
                        max-width="290px"
                        min-width="290px"
                    >
                    <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                            v-model="end_time"
                            label="End Time"
                            outlined
                            prepend-icon="mdi-clock-outline"
                            readonly
                            v-bind="attrs"
                            v-on="on"
                            :rules="timeRules" 
                            required
                            :error="allerror.end_time"
                            :error-messages="allerror.end_time"
                        ></v-text-field>
                    </template>
                    <v-time-picker
                        v-if="menu3"
                        v-model="end_time"
                        full-width
                        :allowed-minutes="allowedSteps"
                        :min="start_time"
                        @click:minute="$refs.menu3.save(end_time)"
                    ></v-time-picker>
                    </v-menu>
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
                    @click="submit"
                    :loading="loading"
                    >Save
                    </v-btn>
                </v-col>
            </v-row>
        </v-form>
     </div>
</template>

<script>
import moment from 'moment'

export default {
    data: () => ({
        loading: false,
        isSubmitted: false,
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
        start_time: null,
        menu2: false,
        timeRules: [
        v => !!v || 'Time is required',
        ],
        menu3: false,
        end_time: null,
        allerror: []
    }),
    methods: {
        // validate(){
        //     if(
        //         this.title != '' && 
        //         this.date != '' && 
        //         this.timezone != '' &&
        //         this.start_time != '' &&
        //         this.end_time != ''
        //     ){
        //         return true
        //     }else{
        //         return false
        //     }
        // },
        // validate(){
        //     this.$refs.form.validate()
        // },
        allowedSteps: m => m % 10 === 0,
        
        submit(){
            if(this.$refs.form.validate()){
                this.loading = true;
                this.isSubmitted = true;

                axios
                .post("/inst/create-basics", {
                    title: this.title,
                    date: this.date,
                    timezone: this.timezone,
                    start_time: this.start_time,
                    end_time: this.end_time
                })
                .then(response => {
                    this.loading = false;
                    this.$emit('basicsAdded');
                    // this.title = '';
                    // this.date = '';
                    // this.timezone = '';
                    // this.start_time = '';
                    // this.end_time = '';
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

</style>