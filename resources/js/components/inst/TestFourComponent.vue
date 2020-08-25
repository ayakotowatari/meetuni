<template>
  <v-form v-model="valid">
    <v-container>
      <v-row>
        <v-col
          cols="12"
          md="4"
        >
          <v-text-field
            v-model="name"
            :rules="nameRules"
            :counter="20"
            label="Name"
            required
          ></v-text-field>
        </v-col>
        <v-col
          cols="12"
          md="4"
        >
          <v-text-field
            v-model="email"
            :rules="emailRules"
            label="E-mail"
            required
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row>
      <v-col cols="12" sm="6" md="4">
      <v-menu
        ref="menu"
        v-model="menu"
        :close-on-content-click="false"
        :return-value.sync="date"
        transition="scale-transition"
        offset-y
        min-width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            v-model="date"
            label="Picker in menu"
            prepend-icon="event"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker v-model="date" no-title scrollable>
          <v-spacer></v-spacer>
          <v-btn text color="primary" @click="menu = false">Cancel</v-btn>
          <v-btn text color="primary" @click="$refs.menu.save(date)">OK</v-btn>
        </v-date-picker>
      </v-menu>
    </v-col>
        
      </v-row>
        <v-btn @click="updateEvent(id, name, email, date, time)"></v-btn>
    </v-container>
  </v-form>
</template>

<script>
  export default {
    data: () => ({
      valid: false,
      testform: {},
      name: '',
      nameRules: [
        v => !!v || 'Name is required',
        v => v.length <= 20 || 'Name must be less than 20 characters',
      ],
      email: '',
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+/.test(v) || 'E-mail must be valid',
      ],
      date: null,
      menu: false,
      time2: null,
      menu2: false,
    }),
    created(){
        this.fetchDetails();
    },
    methods: {
        fetchDetails: function() {
            axios
            .get('/inst/testform')
             .then(res => {
            console.log(res);
            this.id = res.data.testform.id;
            this.name = res.data.testform.name;
            this.email = res.data.testform.email;
            this.date = res.data.testform.date;
            this.time = res.data.testform.time;
        })
        },
        updateEvent(id, name, email, date, time){
          console.log(id);
          console.log(name);
          console.log(email);
          console.log(date);
          console.log(time);

          axios
          .post('/inst/testform/update', {
            id: this.id,
            name: this.name,
            email: this.email,
            date: this.date,
            time: this.time
          })
          .then(response => {
            this.fetchDetails();
          })
          .catch(err => {
              this.message = err;
          })
          
        }
    }
  }
</script>