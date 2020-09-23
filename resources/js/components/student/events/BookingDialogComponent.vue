<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" persistent max-width="600px">
            <v-card>
            <v-card-title>
                <span class="headline">Event Booking</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-form ref="form">
                        <v-row>
                            <v-col cols="12" sm="12" md="6">
                                <v-text-field 
                                    v-model= "first_name" 
                                    label="First name*" 
                                    :rules="firstnameRules"
                                    required
                                    :error="allerror.first_name"
                                    :error-messages="allerror.first_name"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="12" md="6">
                                <v-text-field 
                                    v-model= "last_name" 
                                    label="Last name*" 
                                    :rules="lastnameRules"
                                    required
                                    :error="allerror.last_name"
                                    :error-messages="allerror.last_name"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="12" md="6">
                                <v-text-field 
                                    v-model= "email" 
                                    label="Email*" 
                                    :rules="emailRules"
                                    required
                                    :error="allerror.email"
                                    :error-messages="allerror.email"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="12" md="6">
                                <v-text-field  
                                    label="Confirm Email*" 
                                    :rules="confirmemailRules"
                                    required
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-form>
                </v-container>
                <small>*indicates required field</small>
                <p>By clicking 'Register', I accept the Terms of Services and have read the Privacy Policy. I agree that the MeetUni may share my information with the event organizer.</p>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="grey" text @click="closeDialog">Not Now</v-btn>
                <v-btn color="blue darken-1" text @click="book">Register</v-btn>
            </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
import { mapState, mapMutations, mapActions } from 'vuex'

export default {
    props: {
        event: Object,
        dialog: Boolean
    },
    data: function(){
        return {
            first_name: '',
            firstnameRules: [
                v => !!v || 'First name is required',
            ],
            last_name: '',
            lastnameRules: [
                v => !!v || 'Last name is required',
            ],
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
    computed: {
        ...mapState('studentaccount', [
            'allerror', 
            'eventId',
        ]),
    },
    methods: {
        ...mapMutations('studentaccount', {
            closeDialog: 'closeDialog'
        }),
        ...mapActions('studentaccount', [
            'bookEvent'
        ]),
        book(){
            console.log('check');
          
            if(this.$refs.form.validate()){
                this.bookEvent({
                    event_id: this.eventId,
                    first_name: this.first_name,
                    last_name: this.last_name,
                    email: this.email
                })
            }
        }
    },
}
</script>

<style>

</style>