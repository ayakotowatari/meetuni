<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" persistent max-width="600px">
            <v-card>
            <v-card-title>
                <span class="headline">Reschedule Your Email</span>
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
                                        label="Reschedule Date"
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
                                        label="Reschedule Time"
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
                                    @click:minute="$refs.menu2.save(time)"
                                ></v-time-picker>
                                </v-menu>
                            </v-col>        
                        </v-row>
                        <v-row>
                            <v-col cols="12" sm="12" md="6">
                                <v-select
                                    v-model="timezone"
                                    :items="timezones"
                                    item-value='zone'
                                    label="Timezone"
                                    :rules="timezoneRules" 
                                    persistent-hint
                                    required
                                    :error="allerror.timezone"
                                    :error-messages="allerror.timezone"
                                >
                                <template v-slot:selection="data">
                                    {{ data.item.zone }} ({{ data.item.GMT_difference }}) 
                                </template>
                                <template v-slot:item="data">
                                    {{ data.item.zone }} ({{ data.item.GMT_difference }})
                                </template>
                                </v-select>
                            </v-col>
                        </v-row>
                    </v-form>
                </v-container>
                <p>By clicking 'Reschedule', a request will be registered.</p>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="grey" text @click="closeDialogForReschedule">Discard</v-btn>
                <v-btn color="blue darken-1" text @click="reschedule">Reschedule</v-btn>
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
        event_id: String,
        user: Object
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
    mounted(){
        this.$store.dispatch('getTimezoneList');
    },
    computed: {
        ...mapState('notifications',[
            'allerror'
        ]),
        ...mapState([
            'timezones'
        ]),
        timezone: {
            get(){
                return this.user.timezone
            },
            set (value) {
                this.$store.commit('updateTimezone', value)
            }
        },
    },
    methods: {
        ...mapMutations('notifications', {
            closeDialogForReschedule: 'closeDialogForReschedule'
        }),
        ...mapActions('notifications',[
            'rescheduleEmailToParticipants'
        ]),
        reschedule(){

            if(this.$refs.form.validate()){
                this.rescheduleEmailToParticipants({
                    event_id: this.event_id,
                    scheduled_date: this.date,
                    scheduled_time: this.time,
                    timezone: this.timezone
                })
            }
            
        },
        // allowedSteps: m => m % 10 === 0,
    }
}
</script>

<style>

</style>