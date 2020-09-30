<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" persistent max-width="320">
            <v-card>
                <v-card-title class="headline">
                    <p>Sign in to <span class="error--text">save</span> this event</p> 
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
        eventId: String
    },
    data: function(){
        return {
           
        }
    },
    computed: {
        
    },
    methods: {
        ...mapMutations('student', {
            closeDialog: "closeDialogForLoginToLike"
        }),
        ...mapActions('student', [
            'loginPageToLike',
            'openLoginPage'
        ]),
        open(id){
            // console.log('check');
            // console.log(id);
            this.openLoginPage({
                event_id: id
            })
            
        }
    }
}
</script>

<style>

</style>