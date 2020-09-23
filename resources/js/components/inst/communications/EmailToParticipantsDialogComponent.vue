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
                                <v-select
                                    v-model="selectedEvent"
                                    :items="events"
                                    item-text="title_date"
                                    item-value='id'
                                    label="Select Events"
                                    :rules="eventRules" 
                                    required
                                    :error="allerror.event"
                                    :error-messages="allerror.event"
                                ></v-select>
                            </v-col>
                        </v-row>
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
                    </v-form>
                </v-container>
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
    props: {
        user: Object
    },
    data: function(){
        return {
            selectedEvent: '',
            eventRules:  [
            v => !!v || 'Event is required',
            ],
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
        }
    },
    mounted(){
        this.$store.dispatch('notifications/fetchEventsForEmails');
    },
    computed: {
        ...mapState('notifications',[
            'events',
            'dialog',
            'allerror'
        ])
    },
    methods: {
        ...mapMutations('notifications', {
            closeDialog: 'closeDialog'
        }),
        ...mapActions('notifications',[
            'saveEmailToParticipantsFromDashboard'
        ]),
        save(){

            if(this.$refs.form.validate()){
                this.saveEmailToParticipantsFromDashboard({
                    user_id: this.user.id,
                    event_id: this.selectedEvent,
                    subject: this.subject,
                    body_text: this.body,
                    respond_email: this.email,
                })
            }
            
        },
        allowedSteps: m => m % 10 === 0,
    }
}
</script>

<style>

</style>