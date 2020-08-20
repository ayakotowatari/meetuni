<template>
  <v-container>
      <h1 class="subheading grey--text">Dashboard</h1>
      <v-row>
          <v-col col="12" sm="4">
              <p class="heading">{{ project.title }}</p>
              <p>{{ project.date }} </p>
              <p>{{ project.region }}</p>
              <p>{{ formatDate(project.start_utc, user.timezone) }}</p>
          </v-col>
          <v-spacer></v-spacer>
          <v-menu bottom left offset-y>
            <template v-slot:activator="{ on, attrs }">
                <v-btn 
                    text 
                    color="grey darken"
                    v-bind="attrs"
                    v-on="on"
                >
                <v-icon left>mdi-chevron-down</v-icon>
                <span>Menu</span>
                </v-btn>
            </template>

            <v-list>
                <v-list-item
                v-for="(item, i) in items"
                :key="i"
                >
                <v-list-item-title>{{ item.title }}</v-list-item-title>
                </v-list-item>
            </v-list>
          </v-menu>
         
         
      </v-row>
      
  </v-container>
</template>

<script>
import moment from 'moment-timezone'

export default {

props: {
    user: Object,
},

data: function(){
    return{
        id: this.$route.params.id,
        project:{},
        items: [
            { title: 'Click Me' },
            { title: 'Click Me' },
            { title: 'Click Me' },
            { title: 'Click Me 2' },
         ],
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
    formatDate(value, timezone){
            return moment.utc(value).local().tz(timezone).format("ddd, MMM Do YYYY h:mm a ([GMT] Z)")
    },
}
}
</script>

<style>

</style>