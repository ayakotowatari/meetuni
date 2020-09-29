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
                    @click="dialog = !dialog"
                >
                    <v-icon>mdi-close</v-icon>
                </v-btn>
                </v-toolbar>
                <v-row justify="center">
                    <v-col cols="12" sm="12" md="6">
                        <h3>Sign in to save this event</h3>

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
        dialog: Boolean
    },
    data: function(){
        return {
           
        }
    },
    computed: {
        
    },
    methods: {
        closeDialog(){
            this.dialog = false;
        },
        toLogIn(){
            window.location.href = "/student/login";
        }
    }
}
</script>

<style>

</style>