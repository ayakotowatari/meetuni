<template>
  <v-container>
      <h1 class="subheading grey--text">My Profile</h1>
      <span>{{ user.first_name}} </span> 
      <span>{{ user.last_name}}</span>
      <p>{{ user.email }}</p>
      <p>{{ formatDate(user.created_at, user.timezone) }}</p>
  </v-container>
</template>

<script>
// import moment from 'moment'
import moment from 'moment-timezone'

export default {
    props: {
        user: Object,
    },
    data: () => ({
       
    }),
    methods: {
        // formatDate(value){
        //     return moment.utc(value).local().format("ddd, MMM Do YYYY h:mm a Z")
        // },
        
    },
    computed:{
        formatDate(value, timezone){
            return moment.utc(value).local().tz(timezone).format("ddd, MMM Do YYYY h:mm a ([GMT] Z)")
        },
    }
}
</script>

<style>

</style>