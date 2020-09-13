<template>
    <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="290">
      <v-card>
        <v-card-title class="headline">Get alerts for new events</v-card-title>
        <!-- <v-card-subtitle>
            <p>{{ event.date }}</p>
            <p>{{ event.title }}</p>
        </v-card-subtitle> -->
        <v-card-text>By clicking Yes, you are agreeing to receive notifications and marketing emails so that you won't miss out any opportunities.</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="info darken-1" text @click="receive(user.id)">Yes</v-btn>
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
        user: Object
    },
    computed: {
        ...mapState('studentaccount', [
            'instId'
        ])
    },
    methods:{
        ...mapActions('studentaccount', [
            'receiveAlerts'
        ]),
        receive(id){
            this.receiveAlerts({
                id: id,
                inst_id: this.instId
            });
        },
        ...mapMutations('studentaccount', {
            close: 'closeRefollowDialog'
        })
    }
}
</script>

<style>

</style>