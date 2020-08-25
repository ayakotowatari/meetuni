<template>
    <v-app>
        <navbar-component 
            v-bind:user="user" 
            v-bind:inst="inst" 
            v-bind:initials="initials"
        ></navbar-component>
        <v-main class="mx-4 mb-4">
            <router-view 
                v-bind:events="events"
                v-bind:user="user" 
                v-bind:levels="levels"
                v-bind:subjects="subjects"
                v-bind:regions="regions"
            >
            </router-view>
        </v-main>
    </v-app>
</template>

<script>
export default {

   data: () => ({
       user: {},
       inst: {},
       initials: '',
       events: [],
       levels:[],
       subjects:[],
       regions:[],

   }),
   created(){

      this.fetchUser();
      this.fetchInst();
      this.fetchInitials();
      this.fetchEvents();
      this.fetchLevels();
      this.fetchSubjects();
      this.fetchRegions();

   },
   methods: {
       
      fetchUser: function() {
          axios.get("/inst/fetch-user").then(res => {
            this.user = res.data.user;
          });
      },

      fetchInst: function() {
          axios.get("/inst/fetch-inst").then(res => {
            this.inst = res.data.inst;
          });
      },

      fetchInitials: function() {
          axios.get("/inst/fetch-initials").then(res => {
            this.initials = res.data.initials;
          });
      },
      fetchEvents: function() {
          axios.get("/inst/fetch-events").then(res => {
            this.events = res.data.events;
          })
      },
      fetchLevels: function() {
          axios.get("/inst/fetch-levels").then(res => {
            this.levels = res.data.levels;
          })
      },
      fetchSubjects: function() {
          axios.get("/inst/fetch-subjects").then(res => {
            this.subjects = res.data.subjects;
          })
      },
      fetchRegions: function() {
          axios.get("/inst/fetch-regions").then(res => {
            this.regions = res.data.regions;
          })
      },
   }
    
       
       
}
</script>

<style>

</style>
