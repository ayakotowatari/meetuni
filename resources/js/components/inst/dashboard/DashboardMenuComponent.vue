<template>
   <v-menu open-on-hover offset-y>
    <template v-slot:activator="{ on, attrs }">
        <v-btn 
        depressed 
        class="grey--text"
        v-bind="attrs"
        v-on="on">
            <v-icon left>mdi-chevron-down</v-icon>
            <span>Menu</span>
        </v-btn>
    </template>
    <v-list>
      <v-list-item v-for="link in links" :key="link.text" router :to="{ name:link.route, params:{id: id}}">
        <v-list-item-action>
            <v-icon left class="grey--text text--darken-3">{{ link.icon }}</v-icon>
        </v-list-item-action>
        <v-list-item-content>
            <v-list-item-title class="grey--text text--darken-3">{{ link.text }}</v-list-item-title>
        </v-list-item-content>
     </v-list-item>
    </v-list>
    </v-menu>
</template>

<script>
export default {
  props: {
      id: Number,
  },
  data: () => ({
      offset: true,
      links: [
                { icon: 'mdi-view-dashboard-variant-outline', text: 'Dashboard', route: 'dashboard' },
                { icon: 'mdi-account-group-outline', text: 'Manage Participants', route: 'manage-participants' },
                // { icon: 'mdi-email-outline', text: 'Communications', route: 'participant-communications' },
                { icon: 'mdi-chart-line', text: 'Participant Statistics', route: 'participant-statistics' },
             ],
  }),
}
</script>

<style>

</style>