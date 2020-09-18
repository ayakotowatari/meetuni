<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" persistent max-width="390">
            <v-card>
                <v-card-title>An invidation has been sent to your member.</v-card-title>
                <!-- <v-card-text>By clicking Confirm, an invitation will be sent to this new member to register.</v-card-text> -->
                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="info darken-1" text @click="toAdd">Add more</v-btn>
                <v-btn color="grey" text @click="redirectToTeam">Show my team</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
    computed: {
        ...mapState([
            'dialog'
        ])
    },
    methods: {
        ...mapActions([
            'toAddMembers',
            'toTeam',
        ]),
        toAdd(){
            this.toAddMembers();
            // this.$router.push({name: 'add-members'})
        },
        redirectToTeam(){
            this.toTeam();
            // this.$router.push({name: 'inst-team'})
        }

    }
}
</script>

<style>

</style>