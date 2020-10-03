<template>
    <v-app>
        <homenavbar-component></homenavbar-component>
        <v-main class="mx-4 mb-4">
            <v-container>
                <v-row class="mt-4 mb-10">
                    <v-col cols="12" sm="12" md="8">
                        <h1 class="topline primary--text">A few steps away from <br class="md"> the students across the world</h1>
                        <h3 class="subline grey--text">Reach out and get students registered to your online information sessions and taster lectures.</h3>
                    </v-col>
                </v-row>
                <h1 class="grey--text text--darken-2 mb-10">Why use meetUni ?</h1>
                <v-row justify="center" align="center" class="mb-8">
                    <v-col cols="12" sm="12" md="4">
                        <v-img 
                            src="/storage/illustration/calendar-colour-1200px.png" 
                            cover 
                        >
                        </v-img>
                    </v-col>
                    <v-col cols="12" sm="12" md="4">
                        <h1 class="mb-2">Take Control</h1>
                        <p class="body-1">Promote online informational seminars about your universities and taster lectures of your star academics at any time of your choice. <br>You don't need to wait for seasonal fairs to reach out and meet your prospective students. </p> 
                    </v-col>
                </v-row>
                <v-row justify="center" align="center" class="mb-8">
                    <v-col cols="12" sm="12" md="4" class="hidden-sm-and-down">
                        <h1 class="mb-2">Reach out with ease</h1>
                        <p class="body-1">	Create and publish a beautiful event listing with built-in booking and notifications system as well as analytics.
</p> 
                    </v-col>
                    <v-col cols="12" sm="12" md="4" class="hidden-sm-and-down">
                        <v-img 
                            src="/storage/illustration/drawkit-server-woman-colour-1200px.png" 
                            cover 
                        >
                        </v-img>
                    </v-col>
                    <v-col cols="12" sm="12" md="4" class="hidden-md-and-up">
                        <v-img 
                            src="/storage/illustration/drawkit-server-woman-colour-1200px.png" 
                            cover 
                        >
                        </v-img>
                    </v-col>
                    <v-col cols="12" sm="12" md="4" class="hidden-md-and-up">
                        <h1 class="mb-2">Reach out with ease</h1>
                        <p class="body-1">	Create and publish a beautiful event listing with built-in booking and notifications system as well as analytics.
</p> 
                    </v-col>
                </v-row>
                <v-row justify="center" align="center">
                    <v-col cols="6" sm="6" md="2">
                        <v-img 
                            src="/storage/illustration/character 15.svg" 
                            cover 
                        >
                        </v-img>
                    </v-col>
                     <v-col cols="6" sm="6" md="2">
                        <v-img 
                            src="/storage/illustration/character 14.svg" 
                            cover 
                        >
                        </v-img>
                    </v-col>
                    <v-col cols="12" sm="12" md="4">
                        <h1 class="mb-2">Work as a team</h1>
                        <p class="body-1">You can build a team in meetUni. Invite as many colleagues as you like to work in team to achieve maximum results. 
</p>           
                    </v-col>
                </v-row>
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
