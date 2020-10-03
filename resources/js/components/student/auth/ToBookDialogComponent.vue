<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" persistent max-width="320">
            <v-card>
                <v-card-title class="headline">
                    <p>Sign in to <span class="primary--text">book</span> this event</p> 
                </v-card-title>
                <!-- <v-card-subtitle>
                    <p>{{ event.date }}</p>
                    <p>{{ event.title }}</p>
                </v-card-subtitle> -->
                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="grey" text @click="closeDialog">not now</v-btn>
                <v-btn color="info darken-1" text @click="open(eventId)">sign in</v-btn>
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
        eventId: Number
    },
    data: function(){
        return {
           
        }
    },
    computed: {
    
    },
    methods: {
        ...mapMutations('studentaccount', {
            closeDialog: "closeDialogForLoginToBook"
        }),
        ...mapActions('studentaccount', [
            'openLoginPageToBook'
        ]),
        // closeDialog(){
        //     this.dialog = false;
        // },
        open(id){
            // console.log('check');
            // console.log(id);
            this.openLoginPageToBook({
                event_id: id
            })
            // window.location = '/student/login'
        }
    }
}
</script>

<style>

</style>