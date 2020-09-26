<template>
<div>
  <!-- <v-snackbar v-model="snackbar" :timeout="4000" bottom>
          <span>A new event has been added.</span>
          <template v-slot:action="{ attrs }">
              <v-btn 
                depressed 
                text 
                class="white--text" 
                v-bind="attrs" 
                @click="snackbar = false"
              >Close
              </v-btn>
          </template>
  </v-snackbar> -->
  <v-container>
  <h1 class="grey--text">Create Events</h1>
      <eventbasics-component @basicsAdded = "hideSelect = false" v-bind:user="user"></eventbasics-component>
      <eventselect-component :hideSelect="hideSelect" @selectsAdded = "hideFile = false"></eventselect-component>
      <eventfile-component :hideFile="hideFile" @eventAdded = "dialog = true"></eventfile-component>
  </v-container>
</div>
</template>

<script>
import EventBasics from './EventBasicsComponent'
import EventSelect from './EventSelectComponent'
import EventFile from './EventFileComponent'

export default {
  components: { 
    EventBasics,
    EventSelect,
    EventFile
  },
  props: {
      user: Object,
  },
  data: () => ({
    valid: true,
    hideSelect: true,
    hideFile: true,
    loading: false,
    allerror: [],
    dialog: true
    // snackbar: false
  }),
  methods: {
    validate(){
      this.$refs.form.validate()
    },
  },
  computed: {
  }

}
</script>

<style>

</style>