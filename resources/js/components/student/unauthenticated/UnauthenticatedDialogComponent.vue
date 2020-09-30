<template>
    <v-row justify="center">
        <v-dialog 
            v-model="dialog" 
            fullscreen
            hide-overlay
            transition="dialog-bottom-transition"
        >
            <v-card>
                <v-toolbar flat>
                <v-btn
                    icon
                    @click="closeDialog"
                >
                    <v-icon>mdi-close</v-icon>
                </v-btn>
                </v-toolbar>
                <v-row justify="center">
                    <v-col cols="12" sm="12" md="4">
                        <h3>Sign in to save this event</h3>
                    </v-col>
                </v-row>
                 <v-row justify="center">
                    <v-col cols="12" sm="12" md="4">
                        <v-btn @click="toLogIn(eventId)">Sign in</v-btn>
                    </v-col>
                </v-row>
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
        ...mapMutations('student', {
            closeDialog: "closeDialogForLogInToLike"
        }),
        ...mapActions('student', [
            'loginToLike'
        ]),
        closeDialog(){
            this.dialog = false;
        },
        toLogIn(id){
            // console.log('check');
            // console.log(id);
            this.$router.push({name: 'student-login', params: {id: payload.event_id}});
        }
    }
}
</script>

<style>

</style>