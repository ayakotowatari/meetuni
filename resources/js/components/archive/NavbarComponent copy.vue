<template>
  <div>
    <v-app-bar
       flat color="white"
    >
      <v-app-bar-nav-icon @click="drawer = true"></v-app-bar-nav-icon>

      <v-toolbar-title >
          <span class="font-weight-bold primary--text">meet<span class="font-weight-light">Uni</span></span> 
      </v-toolbar-title>
      <v-spacer></v-spacer>

       <!-- dropdown menu
          <v-menu offset-y>
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
                  <v-list-item v-for="link in links" :key="link.text" router :to="link.route">
                      <v-list-item-icon>
                        <v-icon>{{ link.icon }}</v-icon> 
                      </v-list-item-icon>
                      <v-list-item-title>
                          {{ link.text }}
                      </v-list-item-title>
                  </v-list-item>
              </v-list>
          </v-menu> -->

      <v-btn text color="grey">
          <span>Log out</span>
          <v-icon right>mdi-logout-variant</v-icon>
      </v-btn>
    </v-app-bar>

    <v-navigation-drawer
      v-model="drawer"
      app
    >
      <v-row>
        <v-col cols="12" align="center" class="mt-5">
            <v-avatar color="success">
                <span class="white--text headline">AT</span>
            </v-avatar>
            <p class="subheading mt-3">
                Ayako Towatari
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
          v-model="drawer"
          active-class="primary--text text--accent-4"
        >
          <v-list-item v-for="link in links" :key="link.text" router :to="link.route">
            <v-list-item-icon>
              <v-icon>{{ link.icon }}</v-icon>
            </v-list-item-icon>
            <v-list-item-title>{{ link.text }}</v-list-item-title>
          </v-list-item>

          <!-- <v-list-item>
            <v-list-item-icon>
              <v-icon>mdi-home-outline</v-icon>
            </v-list-item-icon>
            <v-list-item-title>My Projects</v-list-item-title>
          </v-list-item>

           <v-list-item>
            <v-list-item-icon>
              <v-icon>mdi-pencil-outline</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Create Events</v-list-item-title>
          </v-list-item>

           <v-list-item>
            <v-list-item-icon>
              <v-icon>mdi-file-document-outline</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Drafts</v-list-item-title>
          </v-list-item>

          <v-list-item>
            <v-list-item-icon>
              <v-icon>mdi-account-details-outline</v-icon>
            </v-list-item-icon>
            <v-list-item-title>My Profile</v-list-item-title>
          </v-list-item> -->

        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
    </div>
</template>

<script>
  export default {
    data: () => ({
      drawer: false,
       links: [
                { icon: 'mdi-home-outline', text: 'My Projects', route: '/inst/projects' },
                { icon: 'mdi-pencil-outline', text: 'Create Events', route: '/inst/create-events' },
                { icon: 'mdi-file-document-outline', text: 'Drafts', route: '/inst/drafts'},
                { icon: 'mdi-account-details-outline', text: 'My Profile', route: '/inst/profile' },
       ],
    }),
  }
</script>

<style>

</style>