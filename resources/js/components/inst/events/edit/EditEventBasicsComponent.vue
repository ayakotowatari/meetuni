<template>
    <div>
        <v-row justify="center">
            <v-col col="12" sm="12" md="8">
                <h3 class="py-0">Basic Information</h3>
            </v-col>  
        </v-row>
        <v-form class="mb-6" ref="form">
            <v-row justify="center">
                <v-col cols="12" sm="12" md="8">
                    <p>{{ event.title }}</p> 
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
                    <p>{{ event.date }}</p>
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
                        <v-chip class="ma-2">{{ event.timezone }}</v-chip>
                    </div>
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col cols="12" sm="12" md="4">
                    <p>{{ event.start_time }}</p>
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
                    <p>{{ event.end_time }}</p>
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
                <v-col col="12" sm="12" md="8">
                    <v-btn 
                    depressed 
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

import { mapState, mapActions } from 'vuex'

export default {
    props: {
        id: String,
        event: Object
        // title: String,
        // date: String,
        // timezone: String,
        // time: String,
        // time2: String,
    },
    data: () => ({
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
    mounted(){
        // this.$store.dispatch('fetchSingleEvent', {
        //     id: this.id
        // });
    },
    computed: {
        // ...mapState([
        //     'event'
        // ]),
        title: {
            get(){
                return this.$store.state.event.title
            },
            set (value) {
                this.$store.commit('updateEventTitle', value)
            }
        },
        date: {
            get(){
                return this.$store.state.event.date
            },
            set (value) {
                this.$store.commit('updateEventDate', value)
            }
        },
        timezone: {
            get(){
                return this.$store.state.event.timezone
            },
            set (value) {
                this.$store.commit('updateEventTimezone', value)
            }
        },
        start_time: {
            get(){
                return this.$store.state.event.start_time
            },
            set (value) {
                this.$store.commit('updateEventStartTime', value)
            }
        },
        end_time: {
            get(){
                return this.$store.state.event.end_time
            },
            set (value) {
                this.$store.commit('updateEventEndTime', value)
            }
        },
    },
    methods: {
        // validate(){
        //     this.$refs.form.validate()
        // },
        allowedSteps: m => m % 10 === 0,
        ...mapActions([
            'updateEventBasics'
        ]),
        submit(){
            if(this.$refs.form.validate()){
                // this.loading = true;
                this.updateEventBasics({
                    loading: true,
                    id: this.id,
                    title: this.title,
                    date: this.date,
                    timezone: this.timezone,
                    start_time: this.start_time,
                    end_time: this.end_time
                });
            }
        }
    },
}
</script>

<style>
.selected{
    margin-left: 36px;
}
</style>