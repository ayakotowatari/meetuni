<template>
    <v-app>
         <navbar-component></navbar-component>
         <v-main class="mx-4 mb-4">
            <router-view
               v-bind:user="user"
               v-bind:isLoggedIn="isLoggedIn"
            ></router-view>
         </v-main>
    </v-app>
</template>

<script>
import { mapState } from 'vuex'

export default {

   data: () => ({
      //  user: {},
      //  inst: {},
      //  initials: '',
   }),
   mounted(){
      this.$store.dispatch('student/fetchStudentUser')
      // this.fetchUser();
      // this.fetchInst();
      // this.fetchInitials();

   },
   computed: {
      ...mapState('student',[
         'user',
         'isLoggedIn'
      ]),
   },
   methods: {
       
      // fetchUser: function() {
      //     axios.get("/inst/fetch-user").then(res => {
      //       this.user = res.data.user;
      //     });
      // },

      // fetchInst: function() {
      //     axios.get("/inst/fetch-inst").then(res => {
      //       this.inst = res.data.inst;
      //     });
      // },

      // fetchInitials: function() {
      //     axios.get("/inst/fetch-initials").then(res => {
      //       this.initials = res.data.initials;
      //     });
      // },
      // fetchEvents: function() {
      //     axios.get("/inst/fetch-events").then(res => {
      //       this.events = res.data.events;
      //     })
      // },
      // fetchLevels: function() {
      //     axios.get("/inst/fetch-levels").then(res => {
      //       this.levels = res.data.levels;
      //     })
      // },
      // fetchSubjects: function() {
      //     axios.get("/inst/fetch-subjects").then(res => {
      //       this.subjects = res.data.subjects;
      //     })
      // },
      // fetchRegions: function() {
      //     axios.get("/inst/fetch-regions").then(res => {
      //       this.regions = res.data.regions;
      //     })
      // },
   }
}
</script>

<style>

</style>
