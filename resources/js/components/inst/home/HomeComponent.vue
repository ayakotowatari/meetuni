<template>
    <v-app>
        <homenavbar-component></homenavbar-component>
        <v-main class="mx-4 mb-4">
            <v-container>
                <v-row class="mt-4 mb-6">
                    <v-col cols="12" sm="12" md="8">
                        <h1 class="topline primary--text">A few steps away from <br class="md"> the students across the world</h1>
                        <h3 class="subline grey--text">Reach out and get students registered to your online information sessions and taster lectures.</h3>
                    </v-col>
                </v-row>
                <h1>Why use meetUni ?</h1>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import HomeNavbar from '../home/HomeComponent'

export default {
    
    components: {
        HomeNavbar
    },
    data: () => ({
      //  user: {},
      //  inst: {},
      //  initials: '',
    }),
    mounted(){
      
    },
    created(){

      // this.fetchUser();
      // this.fetchInst();
      // this.fetchInitials();

    },
    computed: {
    
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

<style scoped>
.topline{
    font-size: 48px;
    line-height: 1.2em;
    margin-bottom: 0.5em;
}
.subline{
    font-size: 24px;
}
.sm{
    display:none;
}

@media(max-width:780px){
    .topline{
        font-size: 36px;
    }
    .md{
        display:none;
    }
    .sm{
        display:block;
    }
}


</style>
