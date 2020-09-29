<template>
  <v-data-table
    v-model="selected"
    :headers="headers"
    :items="questions"
    item-key="id"
    show-select
    class="elevation-1"
  >
  </v-data-table>
</template>

<script>
import { mapState } from 'vuex'

export default {
     props: {
        id: String,
     },
     data: () => {
      return {
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
          { text: 'Category', value: 'category' },
          { text: 'Sent At', value: 'created_at' },
          { text: 'Actions', value: 'actions' }
        ],
        allerror: []
      }
    },
    mounted(){
        this.$store.dispatch('eventQuestions/fetchEventQuestions', {
            id: this.id
        })
        // this.fetchEventParticipants();
    },
    computed: {
        ...mapState([
            'questions'
        ]),
    },
    methods: {
        // fetchEventParticipants: function(){
        //     axios 
        //         .get("/inst/event-participants" + this.id)
        //         .then(res => {
        //             this.participants = res.data.participants;
        //             console.log(res.data.participants)
        //         })
        //         .catch(error => 
        //             this.allerror = error.response.data.errors
        //         )
        // },
    }

}
</script>

<style>

</style>