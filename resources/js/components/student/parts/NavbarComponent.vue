<template>
  <nav>
    <v-app-bar
      flat app color="white"
    >
      <v-toolbar-title>
        <span class="font-weight-bold primary--text">meet<span class="font-weight-light">Uni</span></span> 
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn text color="grey darken-1" @click.stop="toTopPage">
            <span>top page</span>
      </v-btn>
      <v-menu open-on-hover top offset-y>
          <template v-slot:activator="{ on, attrs }">
              <v-btn
                color="primary"
                text
                v-bind="attrs"
                v-on="on"
              >
                <span class="mr-1">menu</span>  
                <v-icon>mdi-account-outline</v-icon>
              </v-btn>
          </template>
          <v-list>
              <v-list-item>
                  <v-col cols="12" align="center">
                      <v-avatar color="info">
                          <span class="white--text headline">{{ initials }}</span>
                      </v-avatar>
                      <p class="subheading mt-3">
                          {{ user.first_name }} {{ user.last_name }} 
                      </p>
                  </v-col>
              </v-list-item>
              <v-list-item
                v-for="link in links"
                :key="link.text"
                :to="{ name:link.route, params:{id: user.id}}"
              >
                  <v-list-item-action>
                      <v-icon left class="grey--text text--darken-3">{{ link.icon }}</v-icon>
                  </v-list-item-action>
                  <v-list-item-content>
                      <v-list-item-title class="grey--text text--darken-3">{{ link.text }}</v-list-item-title>
                  </v-list-item-content>
              </v-list-item>
              <v-divider></v-divider>
              <v-list-item text @click="logout">
                  <v-list-item-action>
                      <v-icon left class="grey--text">mdi-logout-variant</v-icon>
                  </v-list-item-action>
                  <v-list-item-content>
                  <v-list-item-title class="grey--text">Log out</v-list-item-title>
                      <form id="logout-form" action="/logout" method="POST">
                        <input type="hidden" name="_token" :value="token">
                      </form>
                  </v-list-item-content>
              </v-list-item>
          </v-list>
    </v-menu>

      
    </v-app-bar>

  </nav>
</template>

<script>
import { mapState } from 'vuex'

  export default {
    data: () => ({
      links: [
        { icon: 'mdi-calendar-month-outline', text: 'Booked Events', route: 'booked-events' },
        { icon: 'mdi-eye-outline', text: 'Following', route: 'following' },
        { icon: 'mdi-heart-outline', text: 'Liked', route: 'liked'},
        { icon: 'mdi-account-details-outline', text: 'My Profile', route: 'profile' },
       ],
    }),
    mounted() {
        this.$store.dispatch('fetchUser');
        this.$store.dispatch('fetchInitials');
    },
    computed: {
        token() {
            let token = document.head.querySelector('meta[name="csrf-token"]');
            return token.content
        },
        ...mapState([
            'user',
            'initials'
        ]),
    },
    methods: {
        logout() {
            document.getElementById('logout-form').submit()
        },
        toTopPage(){
          this.$router.push({path: '/student/main'})
        }
    }
  }
</script>