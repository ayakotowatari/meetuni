<template>
   <v-row justify="center">
        <v-dialog v-model="dialog" persistent max-width="390">
            <v-card>
                <v-card-title>Delete your member?</v-card-title>
                <v-card-text>By clicking Confirm, this team member will be deleted from the users list.</v-card-text>
                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="info darken-1" text @click="deleteMember(memberId)">Confirm</v-btn>
                <v-btn color="grey" text @click="closeDialog">Not Now</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
import { mapMutations, mapActions } from 'vuex'

export default {
    props: {
        dialog: Boolean,
        memberId: String
    },
    methods: {
        ...mapMutations({
            closeDialog: 'closeDialog'
        }),
        ...mapActions([
            'deleteTeamMembers'
        ]),
        deleteMember(id){

            console.log('delete');
            console.log(id);

            this.deleteTeamMembers({
                id: id
            })

        }
    }
}
</script>

<style>

</style>