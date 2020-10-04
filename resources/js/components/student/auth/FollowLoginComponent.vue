<template>
    <div>
        <v-row justify="center" class="mb-3">
            <v-col cols="12" sm="12" md="8">
                <h2 class="grey--text text--darken-2">Student Login</h2>
            </v-col>
        </v-row>
          <v-row justify="center">
            <v-col cols="12" sm="12" md="4">
                <v-img 
                    src="/storage/illustration/carry-on-colour1200px.png" 
                    cover 
                >
                </v-img>
            </v-col>
            <v-col cols="12" sm="12" md="4">
                <v-form>
                    <v-row justify="center">
                        <v-col cols="12" sm="12" md="12">
                            <v-text-field
                                v-model="email"
                                label="Email" 
                                outlined
                                required
                                :rules="emailRules" 
                                :error="allLoginError.email"
                                :error-messages="allLoginError.email"
                            ></v-text-field>
                            <v-text-field 
                                v-model="password"
                                label="Password" 
                                :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                :type="showPassword ? 'text' : 'password'"
                                outlined
                                required
                                :rules="passwordRules" 
                                :error="allLoginError.password"
                                :error-messages="allLoginError.password"
                                @click:append="showPassword = !showPassword"
                            ></v-text-field>
                        <v-btn block depressed dark color="primary" class="mb-2" @click="goLogin()">Login</v-btn>
                        <v-btn text color="primary" class="pa-0" @click="toRegister()">register</v-btn>
                    </v-col>
                </v-row>
                    <!-- <input type="hidden" name="event_id" :value="eventId"> -->
                </v-form>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
    data: function(){
        return{
            event_id: this.$route.params.id,
            email: '',
            emailRules: [
                (v) => !!v || 'E-mail is required',
                (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
            ],
            password: '',
            passwordRules: [
                (v) => !!v || 'Password is required',
                (v) => v.length >= 8 || 'Minimum 8 characters'
            ],
            showPassword: false
        }
    },
    computed: {
        ...mapState('studentaccount', [
            'allLoginError',
        ]),
    },
    methods: {
        ...mapActions('studentaccount', [
            'loginToFollow'
        ]),
        goLogin(){    

            this.loginToFollow({
                url: "/student/login",
                email: this.email,
                password: this.password,
                event_id: this.event_id
            })
        },
        toRegister(){
            this.$router.push({name: 'student-register'});
        }
    }


}
</script>

<style>

</style>