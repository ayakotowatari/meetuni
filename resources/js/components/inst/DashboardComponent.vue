<template>
  <v-container>
      <v-row>
        <v-col>
            <h1 class="grey--text">Dashboard</h1>
        </v-col>
        <v-col>
            <dashboardmenu-component />
        </v-col>
      </v-row>
      <v-row class="my-5">
          <v-col col="12" sm="12" md="6">
              <h3 class="grey--text text--darken-4">{{ project.title }}</h3>
              <span>{{ formattedDate(project.date, user.timezone) }} </span>
              <span class="ml-3">
                  {{ formattedStartTime(project.start_utc, user.timezone) }} - 
                  {{ formattedEndTime(project.end_utc, user.timezone) }}
              </span>
              <p>{{ project.region }}</p>
              
          </v-col>         
      </v-row>
      
  </v-container>
</template>

<script>
import moment from 'moment-timezone'
import DashboardMenu from './parts/DashboardMenuComponent'

export default {
components: { DashboardMenu },
props: {
    user: Object,
},

data: function(){
    return{
        id: this.$route.params.id,
        project:{},
    }
    console.log(id);
},
created(){
    this.fetchSingleProject();
},
methods: {
    fetchSingleProject: function(id) {
          console.log(id);
          axios.get("/inst/fetch-single-project/" + this.id).then(res => {
            this.project = res.data.project;
          })
    },
    formattedDate(value, timezone){
        return moment.utc(value).local().tz(timezone).format("ddd, MMM Do YYYY")
    },
    formattedStartTime(value, timezone){
            return moment.utc(value).local().tz(timezone).format("h:mm a")
    },
    formattedEndTime(value, timezone){
            return moment.utc(value).local().tz(timezone).format("h:mm a ([GMT] Z)")
    }
}
}
</script>

<style>

</style>