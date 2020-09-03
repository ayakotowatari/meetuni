<template>
  <v-container>
  <v-form>
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
            :error="allerror.name"
            :error-messages="allerror.name"
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
            :error="allerror.email"
            :error-messages="allerror.email"
          ></v-text-field>
        </v-col>
      </v-row>
        <v-btn @click="submit"></v-btn>
  </v-form>
    </v-container>
</template>

<script>
// import { mapActions } from 'vuex'
import { mapState } from 'vuex'

  export default {
    data: () => ({
      loading: false,
      name: '',
      email: '',
      nameRules: [
        v => !!v || 'Name is required',
        v => v.length <= 20 || 'Name must be less than 20 characters',
      ],
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+/.test(v) || 'E-mail must be valid',
      ],
    }),
    created(){

    },
    computed: {
        ...mapState([
            'allerror'
        ])
    },
    methods: {
        // ...mapActions([
        //     'postDetails'
        // ]),
        submit(){
            this.$store.dispatch('postDetails', {
                name: this.name,
                email: this.email
            })
            // this.postDetails({
            //     name: this.name,
            //     email: this.email
            // });
        },
        // submit(){
        //   this.loading = true;
        //   console.log(id);
        //   console.log(name);
        //   console.log(email);

        //   axios
        //   .post('/inst/testform', {
        //     name: this.name,
        //     email: this.email,
        //   })
        //   .then(response => {
        //     this.loading = false
        //   })
        //   .catch(err => {
        //       this.message = err;
        //   })
          
        // }
    }
  }
</script>