<template>
  <v-container>
    <h1 class="subheading grey--text">My Projects</h1>
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

  export default {
    props: {
      events: Array,
    },
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
        { text: 'Target Region', value: 'region' },
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
        this.$router.push({name: 'edit-event', params: {id: id}})
      },
      // formattedDate(value){
      //   return moment(value).format('ddd, MMM Do YYYY');
      // }
    },
    computed: {
      // change date format
      // formattedDate(){
      //   return this.date ? format(parseISO(this.date), 'EEE, MMM do, yyyy, zzz') : ''
      // },
     
    }

      // editItem (item) {
      //   this.editedIndex = this.desserts.indexOf(item)
      //   this.editedItem = Object.assign({}, item)
      //   this.dialog = true
      // },

      // deleteItem (item) {
      //   const index = this.desserts.indexOf(item)
      //   confirm('Are you sure you want to delete this item?') && this.desserts.splice(index, 1)
      // },

      // close () {
      //   this.dialog = false
      //   this.$nextTick(() => {
      //     this.editedItem = Object.assign({}, this.defaultItem)
      //     this.editedIndex = -1
      //   })
      // },

      // save () {
      //   if (this.editedIndex > -1) {
      //     Object.assign(this.desserts[this.editedIndex], this.editedItem)
      //   } else {
      //     this.desserts.push(this.editedItem)
      //   }
      //   this.close()
      // },
    
  }
</script>