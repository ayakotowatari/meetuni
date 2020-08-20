<template>
  <div>
     <div class="ma-12 pa-12">
    <template>
      <v-card>
        <v-navigation-drawer
          permanent
          expand-on-hover
        >
          <v-list>
            <v-list-item class="px-2">
              <v-list-item-avatar color='success'>
                <span class="white--text headline">{{ initials }}</span>
              </v-list-item-avatar>
            </v-list-item>

            <v-list-item link>
              <v-list-item-content>
                <v-list-item-title class="title"> {{ user.first_name }} {{ user.last_name }} </v-list-item-title>
                <v-list-item-subtitle>{{ inst.name }} </v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-list>

          <v-divider></v-divider>

          <v-list
            nav
            dense
          >
            <v-list-item-group
              v-model="group"
              active-class="primary--text text--accent-4"
            >
              <v-list-item v-for="link in links" :key="link.text" router :to="link.route">
                <v-list-item-icon>
                  <v-icon>{{ link.icon }}</v-icon>
                </v-list-item-icon>
                <v-list-item-title>{{ link.text }}</v-list-item-title>
              </v-list-item>
            </v-list-item-group>
          </v-list>
            </v-navigation-drawer>
          </v-card>
        </template>
      </div>

     <v-navigation-drawer
      v-model="drawer"
      app
      temporary
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
        <v-list-item-group
          v-model="group"
          active-class="primary--text text--accent-4"
        >
          <v-list-item v-for="link in links" :key="link.text" router :to="link.route">
            <v-list-item-icon>
              <v-icon>{{ link.icon }}</v-icon>
            </v-list-item-icon>
            <v-list-item-title>{{ link.text }}</v-list-item-title>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      flat color="white"
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

   
  </div>
</template>

<script>
  export default {
    props: [
      'user',
      'inst',
      'initials',
    ],
    data: () => ({
      drawer: false,
      links: [
        { icon: 'mdi-home-outline', text: 'My Projects', route: '/inst/projects' },
        { icon: 'mdi-pencil-outline', text: 'Create Events', route: '/inst/create-events' },
        { icon: 'mdi-file-document-outline', text: 'Drafts', route: '/inst/drafts'},
        { icon: 'mdi-account-details-outline', text: 'My Profile', route: '/inst/profile' },
       ],
    }),
    computed: {
        token() {
            let token = document.head.querySelector('meta[name="csrf-token"]');
            return token.content
        }
        },
    methods: {
        logout() {
            document.getElementById('logout-form').submit()
        }
    }
  }
</script>