<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" persistent max-width="600px">
            <v-card>
            <v-card-title>
                <span class="headline">Event Booking</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="12" md="6">
                            <v-text-field 
                                v-model= "first_name" 
                                label="First name*" 
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="6">
                            <v-text-field 
                                v-model= "last_name" 
                                label="Last name*" 
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="6">
                            <v-text-field 
                                label="Email*" 
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="6">
                            <v-text-field  
                                v-model= "email" 
                                label="Confirm Email*" 
                                required
                            ></v-text-field>
                        </v-col>
                    </v-row>
                </v-container>
                <small>*indicates required field</small>
                <p>By clicking 'Register', I accept the Terms of Services and have read the Privacy Policy. I agree that the MeetUni may share my information with the event organizer.</p>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="bookEvent">Register</v-btn>
                <v-btn color="blue darken-1" text @click="closeDialog">Close</v-btn>
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
        event: Array,
    },
    methods: {
        ...mapMutations('student', {
            closeDialog: 'closeDialog'
        }),
        ...mapActions('student', [
            'registerEvent'
        ]),
        bookEvent(){
            this.registerEvent({
                event_id: this.event.id,
                first_name: this.first_name,
                last_name: this.last_name,
                email: this.email
            })
        }
    },
    computed: {
        ...mapState('student', [
            'allerror'
        ])
       
    }

}
</script>

<style>

</style>