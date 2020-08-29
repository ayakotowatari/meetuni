<template>
  <v-container>
    <h1 class="subheading grey--text">My Events</h1>
      <v-row>
        <v-col cols="12" sm="4" offset-sm="8">
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
          ></v-text-field>
        </v-col>
      </v-row>
      <v-data-table
          :headers="headers"
          :items="events"
          :search="search"
          class="elevation-1 mt-10"
        >
        <template slot="items" slot-scope="myprops">
          <td v-for="header in headers" :key="header.text">
            {{ myprops.item[header.value] }}
          </td>
        </template>
        <!-- <template v-slot:[`item.date`]="{ item }">
          {{ formattedDate(item.date) }}
        </template> -->
        <template v-slot:[`item.dashboard`]="{ item }">
          <v-icon
            v-show="item.status !== 'Draft'"
            small
            class="mr-4"
            @click="toDashboard(item.id)"
          >
            mdi-open-in-new
          </v-icon>
        </template>
        <template v-slot:[`item.actions`]="{ item }">
          <v-icon
            v-show="item.status !== 'Complete'"
            small
            class="mr-4"
            @click="toEditEvent(item.id)"
          >
            mdi-pencil-outline
          </v-icon>
          <v-icon
            v-show="item.status == 'Complete'"
            small
            class="mr-4"
            @click="editItem(item)"
          >
            mdi-content-copy
          </v-icon>
          <v-icon
            small
            @click="deleteItem(item)"
          >
            mdi-trash-can-outline
          </v-icon>
        </template>
        <template v-slot:[`item.status`]="{ item }">
          <v-chip :color="getColor(item.status)" dark>{{ item.status }}</v-chip>
        </template>
          <!-- <template v-slot:no-data>
            <v-btn color="primary" @click="initialize">Reset</v-btn>
          </template> -->
        </v-data-table>


  </v-container>
</template>

<script>
import moment from 'moment';
import { mapState } from 'vuex';

  export default {
    // props: {
    //   events: Array,
    // },
    data: () => ({
      dialog: false,
      search:'',
      headers: [
        {
          text: 'Title',
          align: 'start',
          sortable: false,
          value: 'title',
        },
        { text: 'Date', value: 'date' },
        { text: 'Status', value: 'status' },
        { text: 'Dashboard', value: 'dashboard', sortable: false },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
    }),
    watch: {
      dialog (val) {
        val || this.close()
      },
    },
    mounted(){
      this.$store.dispatch('fetchEvents')
    },
    methods: {
      getColor(status){
        if (status == 'Ongoing') return 'primary'
        else if (status == 'Draft') return 'error'
        else return 'info'
      },
      toDashboard(id){
        console.log(id); 
        this.$router.push({name: 'dashboard', params: {id: id}})
      },
      toEditEvent(id){
        console.log(id); 
        this.$router.push({name: 'edit-events', params: {id: id}})
      },
    },
    computed: {
        ...mapState([
          'events'
        ])
    }
  }
</script>