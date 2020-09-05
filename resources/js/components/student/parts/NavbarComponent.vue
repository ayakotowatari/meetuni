<template>
  <nav>
    <v-app-bar
      flat app color="white"
    >

      <v-toolbar-title>
        <span class="font-weight-bold primary--text">meet<span class="font-weight-light">Uni</span></span> 
      </v-toolbar-title>
      <v-spacer></v-spacer>

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
      drawer: true,
      links: [
        { icon: 'mdi-home-outline', text: 'My Projects', route: '/inst/events' },
        { icon: 'mdi-pencil-outline', text: 'Create Events', route: '/inst/create-events' },
        { icon: 'mdi-file-document-outline', text: 'Drafts', route: '/inst/drafts'},
        { icon: 'mdi-account-details-outline', text: 'My Profile', route: '/inst/profile' },
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