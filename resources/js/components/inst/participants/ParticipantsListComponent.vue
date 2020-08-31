<template>
  <v-data-table
    v-model="selected"
    :headers="headers"
    :items="participants"
    item-key="last_name"
    show-select
    class="elevation-1"
  >
  </v-data-table>
</template>

<script>
// import {createNamespacedHelpers } from 'vuex'
// const {mapState} = createNamespacedHelpers('participants');
import { mapState } from 'vuex'

export default {
     data () {
      return {
        id: this.$route.params.id,
        selected: [],
        headers: [
          {
            text: 'Last Name',
            align: 'start',
            sortable: false,
            value: 'last_name',
          },
          { text: 'First Name', value: 'first_name' },
          { text: 'E-mail', value: 'email' },
          { text: 'Country', value: 'country' },
          { text: 'Booked At', value: 'created_at' },
          { text: 'Actions', value: 'actions' }
        ],
      }
    },
    mounted(){
        this.$store.dispatch('fetchEventParticipants', {
            id: this.id
        })
    },
    computed: {
        ...mapState([
            'participants'
        ]),
    }

}
</script>

<style>

</style>