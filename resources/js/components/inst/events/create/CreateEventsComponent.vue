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

  <h1 class="grey--text">Create Events</h1>
  <v-container>
      <eventbasics-component @basicsAdded = "hide = false"></eventbasics-component>
      <v-form class="mb-6" v-model="valid">
        <eventselect-component 
          @selectsAdded = "hide = false"
        ></eventselect-component>
      </v-form>
      <v-form class="mb-6" :disabled="hide" v-model="valid">
        <eventfile-component
          @eventAdded = "dialog = true"
        ></eventfile-component>
      </v-form>
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
  data: () => ({
    valid: true,
    loading: false,
    hide: true,
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