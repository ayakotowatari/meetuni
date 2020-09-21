<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" persistent max-width="600px">
            <v-card>
            <v-card-title>
                <span class="headline">Email to Participants</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-form ref="form">
                            <v-row justify="center">
                                <v-col cols="12" sm="12" md="12">
                                    <v-text-field 
                                        v-model= "subject" 
                                        label="Subject" 
                                        :rules="subjectRules"
                                        required
                                        :error="allerror.subject"
                                        :error-messages="allerror.subject"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                            <v-row justify="center">
                                <v-col cols="12" sm="12" md="12">
                                    <v-textarea 
                                        v-model= "body" 
                                        label="Body Text" 
                                        :rules="textareaRules"
                                        rows="8"
                                        required
                                        :error="allerror.body_text"
                                        :error-messages="allerror.body_text"
                                    ></v-textarea>
                                </v-col>
                            </v-row>
                            <v-row justify="center">
                                <v-col cols="12" sm="12" md="6">
                                    <v-text-field 
                                        v-model= "email" 
                                        label="Respond-to Email" 
                                        :rules="emailRules"
                                        required
                                        :error="allerror.respond_email"
                                        :error-messages="allerror.respond_email"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="12" md="6">
                                    <v-text-field  
                                        label="Confirm Email" 
                                        :rules="confirmemailRules"
                                        required
                                    ></v-text-field>
                                </v-col>
                            </v-row>
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
                <p>By clicking 'Schedule', a request to send this email to participants will be registered.</p>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="grey" text @click="closeDialog">Discard</v-btn>
                <v-btn color="blue darken-1" text @click="save">Save</v-btn>
            </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
import { mapState, mapMutations, mapActions } from 'vuex'

export default {
    data: function(){
        return {
            id: this.$route.params.id,
            subject: '',
            subjectRules: [
            v => !!v || 'Subject is required',
            ],
            body: '',
            textareaRules: [
                v => !!v || v.length <= 300 || 'Max 300 characters'
            ],
            respondEmail: '',
            email: '',
            emailRules: [
                (v) => !!v || 'E-mail is required',
                (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
            ],
            confirmemailRules: [
                (v) => !!v || 'Confirmation E-mail is required',
                (v) => v == this.email || 'E-mail must match'
            ],
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
            'dialog',
            'allerror'
        ])
    },
    methods: {
        ...mapMutations('notifications', {
            closeDialog: 'closeDialog'
        }),
        ...mapActions('notifications',[
            'saveEmailToParticipants'
        ]),
        save(){

            if(this.$refs.form.validate()){
                this.saveEmailToParticipants({
                    event_id: this.id,
                    subject: this.subject,
                    body_text: this.body,
                    respond_email: this.email,
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