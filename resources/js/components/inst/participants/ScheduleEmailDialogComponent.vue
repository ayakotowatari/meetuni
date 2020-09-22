<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" persistent max-width="600px">
            <v-card>
            <v-card-title>
                <span class="headline">Schedule Your Email</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-form ref="form">
                            <v-row justify="center">
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
                                            v-model="date"
                                            label="Schedule Date"
                                            hint="Which date would you like the email to be sent?"
                                            readonly
                                            v-bind="attrs"
                                            v-on="on"
                                            :rules="dateRules"
                                            required
                                            :error="allerror.scheduled_date"
                                            :error-messages="allerror.scheduled_date"
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
                                            label="Scheduled Time"
                                            readonly
                                            v-bind="attrs"
                                            v-on="on"
                                            :rules="timeRules" 
                                            required
                                            :error="allerror.scheduled_time"
                                            :error-messages="allerror.scheduled_time"
                                        ></v-text-field>
                                    </template>
                                    <v-time-picker
                                        v-if="menu2"
                                        v-model="time"
                                        full-width
                                        :allowed-minutes="allowedSteps"
                                        @click:minute="$refs.menu2.save(time)"
                                    ></v-time-picker>
                                    </v-menu>
                                </v-col>        
                            </v-row>
                            <v-row>
                                <v-col cols="12" sm="12" md="6">
                                    <v-select
                                        v-model="timezone"
                                        :items="['Asia/Tokyo', 'Europe/London']"
                                        label="Timezone"
                                        :rules="timezoneRules" 
                                        persistent-hint
                                        required
                                        :error="allerror.timezone"
                                        :error-messages="allerror.timezone"
                                    ></v-select>
                                </v-col>
                            </v-row>
                    </v-form>
                </v-container>
                <p>By clicking 'Schedule', a request will be registered.</p>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="grey" text @click="closeDialogForSchedule">Discard</v-btn>
                <v-btn color="blue darken-1" text @click="schedule">Schedule</v-btn>
            </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
import { mapState, mapMutations, mapActions } from 'vuex'

export default {
    props: {
        dialog: Boolean,
        event_id: Number,
    },
    data: function(){
        return {
            menu: false,
            date: null,
            dateRules: [
                v => !!v || 'Date is required',
            ],
            menu2: false,
            time: null,
            timeRules: [
                v => !!v || 'Time is required',
            ],
            timezone: '',
            timezoneRules: [
            v => !!v || 'Timezone is required',
            ],
        }
    },
    computed: {
        ...mapState('notifications',[
            'allerror'
        ])
    },
    methods: {
        ...mapMutations('notifications', {
            closeDialogForSchedule: 'closeDialogForSchedule'
        }),
        ...mapActions('notifications',[
            'scheduleEmailToParticipants'
        ]),
        schedule(){

            if(this.$refs.form.validate()){
                this.scheduleEmailToParticipants({
                    event_id: this.event_id,
                    scheduled_date: this.date,
                    scheduled_time: this.time,
                    timezone: this.timezone
                })
            }
            
        },
        allowedSteps: m => m % 10 === 0,
    }
}
</script>

<style>

</style>