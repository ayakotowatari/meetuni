<template>
  <nav>
    <v-app-bar
      flat app color="white"
    >

      <v-toolbar-title>
        <span class="font-weight-bold primary--text">meet<span class="font-weight-light">Uni</span></span> 
      </v-toolbar-title>
      <v-spacer></v-spacer>
       <v-menu open-on-hover offset-y>
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          color="primary"
          dark
          v-bind="attrs"
          v-on="on"
        >
          Dropdown
        </v-btn>
      </template>

      <v-list>
        <v-list-item
          v-for="link in links"
          :key="link.text"
          router 
          :to="{ name:link.route, params:{id: id}}"
        >
          <v-list-item-title>{{ link.text }}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>

      <v-btn text color="grey" @click="logout">
           <span>Log out</span>
                <form id="logout-form" action="/logout" method="POST">
                  <input type="hidden" name="_token" :value="token">
                </form>
            <v-icon right>mdi-logout-variant</v-icon>
      </v-btn>
    </v-app-bar>

  </nav>
</template>

<script>
import { mapState } from 'vuex'

  export default {
    data: () => ({
      links: [
        { icon: 'mdi-calendar-month-outline', text: 'Booked Events', route: '/student/booked-events' },
        { icon: 'mdi-eye-outline', text: 'Following', route: '/student/following' },
        { icon: 'mdi-heart-outline', text: 'Liked', route: '/student/liked'},
        { icon: 'mdi-account-details-outline', text: 'My Profile', route: '/student/profile' },
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
        }
    }
  }
</script>