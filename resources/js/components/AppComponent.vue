<template>
    <v-app>
        <navbar-component 
            v-bind:user="user" 
            v-bind:inst="inst" 
            v-bind:initials="initials"
        ></navbar-component>
        <v-main class="mx-4 mb-4">
            <router-view 
                v-bind:projects="projects"
                v-bind:user="user" 
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
       projects: [],

   }),
   created(){

      this.fetchUser();
      this.fetchInst();
      this.fetchInitials();
      this.fetchProjects();

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
      fetchProjects: function() {
          axios.get("/inst/fetch-projects").then(res => {
            this.projects = res.data.projects;
          })
      },
   }
    
       
       
}
</script>

<style>

</style>
