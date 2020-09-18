<template>
  <nav>
    <v-app-bar
      flat app color="white"
    >
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

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

     <v-navigation-drawer
      v-model="drawer"
      app
      hide-overlay
    >
      <v-row>
        <v-col cols="12" align="center" class="mt-5">
            <v-avatar color="success">
                <span class="white--text headline">{{ initials }}</span>
            </v-avatar>
            <p class="subheading mt-3">
                {{ user.first_name }} {{ user.last_name }} 
            </p>
            <p class="subheading mt-3">
                {{ inst.name }} 
            </p>
        </v-col>
        <!-- <v-col class="mt-4 mb-3 text-center">
            <Popup @projectAdded="snackbar = true"/>
        </v-col> -->
      </v-row>

      <v-list
        nav
        dense
      >
      <div v-if="`${user.user_type_id}`== 2">
          <v-list-item v-for="link in links" :key="link.text" router :to="link.route">
              <v-list-item-icon>
                  <v-icon>{{ link.icon }}</v-icon>
              </v-list-item-icon>
              <v-list-item-title>{{ link.text }}</v-list-item-title>
          </v-list-item>
      </div>
       <div v-if="`${user.user_type_id}`== 1">
          <v-list-item v-for="link in superAdminLinks" :key="link.text" router :to="link.route">
              <v-list-item-icon>
                  <v-icon>{{ link.icon }}</v-icon>
              </v-list-item-icon>
              <v-list-item-title>{{ link.text }}</v-list-item-title>
          </v-list-item>
      </div>
      </v-list>
    </v-navigation-drawer>


   
  </nav>
</template>

<script>
import { mapState } from 'vuex'

  export default {
    props: {
      user: Object,
      inst: Object
    },
    data: () => ({
      drawer: true,
      links: [
        { icon: 'mdi-home-outline', text: 'My Projects', route: '/inst/events' },
        { icon: 'mdi-pencil-outline', text: 'Create Events', route: '/inst/create-events' },
        { icon: 'mdi-file-document-outline', text: 'Drafts', route: '/inst/drafts'},
        { icon: 'mdi-account-details-outline', text: 'My Profile', route: '/inst/profile' },
      ],
      superAdminLinks : [
        { icon: 'mdi-home-outline', text: 'My Projects', route: '/inst/events' },
        { icon: 'mdi-pencil-outline', text: 'Create Events', route: '/inst/create-events' },
        { icon: 'mdi-file-document-outline', text: 'Drafts', route: '/inst/drafts'},
        { icon: 'mdi-account-group-outline', text: 'My Team', route: '/inst/team' },
        { icon: 'mdi-account-details-outline', text: 'My Profile', route: '/inst/profile' },
      ]
    }),
    mounted() {
        // this.$store.dispatch('fetchUser');
        // this.$store.dispatch('fetchInst');
        this.$store.dispatch('fetchInitials');
    },
    computed: {
        token() {
            let token = document.head.querySelector('meta[name="csrf-token"]');
            return token.content
        },
        ...mapState([
            // 'user',
            // 'inst',
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