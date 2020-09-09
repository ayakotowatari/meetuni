<template>
    <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="290">
      <v-card>
        <v-card-title class="headline">Cancelling this event?</v-card-title>
        <!-- <v-card-subtitle>
            <p>{{ event.date }}</p>
            <p>{{ event.title }}</p>
        </v-card-subtitle> -->
        <v-card-text>By clicking Confirm, your booking for this event will be cancelled.</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="info darken-1" text @click="cancel">Confirm</v-btn>
          <v-btn color="grey" text @click="close">Not Now</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
import { mapState, mapActions, mapMutations } from 'vuex'

export default {
    props: {
        dialog: Boolean,
        event: Object
    },
    computed: {
        ...mapState('studentaccount', [
            'bookingId'
        ])
    },
    methods:{
        ...mapActions('studentaccount', [
            'cancelEvent'
        ]),
        cancel(){
            this.cancelEvent({
                id: this.bookingId
            });
        },
        ...mapMutations('studentaccount', {
            close: 'closeDialog'
        })
    }
}
</script>

<style>

</style>