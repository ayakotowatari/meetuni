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
     props: {
        id: String,
     },
     data: () => {
      return {
        selected: [],
        participants: [],
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
        allerror: []
      }
    },
    created(){
        // this.$store.dispatch('fetchEventParticipants', {
        //     id: this.id
        // })
        this.fetchEventParticipants();
    },
    computed: {
        // ...mapState([
        //     'participants'
        // ]),
    },
    methods: {
        fetchEventParticipants: function(id){
            axios 
                .get("/inst/event-participants" + this.id)
                .then(res => {
                    this.participants = res.data.participants;
                    console.log(res.data.participants)
                })
                .catch(error => 
                    this.allerror = error.response.data.errors
                )
        },
    }

}
</script>

<style>

</style>