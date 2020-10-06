<template>
    <v-container>
        <v-row justify="center" class="mb-3">
            <v-col cols="12" sm="12" md="8">
                <h2 class="grey--text text--darken-2">Student Register</h2>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="4">
                <v-img 
                    src="https://meetuni.s3-ap-northeast-1.amazonaws.com/illustration/travel-tickets-colour-1200px.png" 
                    cover 
                >
                </v-img>
            </v-col>
            <v-col cols="12" sm="12" md="4">
                <v-form>
                    <v-row justify="center">
                        <v-col cols="12" sm="12" md="12">
                            <v-text-field
                                v-model="first_name"
                                label="First Name" 
                                outlined
                                required
                                :rules="firstnameRules"
                                :error="allRegisterError.first_name"
                                :error-messages="allRegisterError.first_name"
                            ></v-text-field>
                            <v-text-field
                                v-model="last_name"
                                label="Last Name" 
                                outlined
                                required
                                :rules="lastnameRules"
                                :error="allRegisterError.last_name"
                                :error-messages="allRegisterError.last_name"
                            ></v-text-field>
                            <v-text-field
                                v-model="email"
                                label="Email" 
                                outlined
                                required
                                :rules="emailRules" 
                                :error="allRegisterError.email"
                                :error-messages="allRegisterError.email"
                            ></v-text-field>
                            <v-text-field 
                                v-model="password"
                                label="Password" 
                                :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                :type="showPassword ? 'text' : 'password'"
                                outlined
                                required
                                :rules="passwordRules" 
                                :error="allRegisterError.password"
                                :error-messages="allRegisterError.password"
                                @click:append="showPassword = !showPassword"
                            ></v-text-field>
                            <v-text-field 
                                v-model="password_confirmation"
                                label="Confirm Password" 
                                :append-icon="showPassword2 ? 'mdi-eye' : 'mdi-eye-off'"
                                :type="showPassword2 ? 'text' : 'password'"
                                outlined
                                required
                                :rules="confirmPasswordRules" 
                                :error="allRegisterError.password_confirmation"
                                :error-messages="allRegisterError.password_confirmation"
                                @click:append="showPassword2 = !showPassword2"
                            ></v-text-field>

                            <input type="hidden" name="timezone" :value="timezone">

                            <v-btn block dark color="primary" class="mb-2" @click="goRegister()">register</v-btn>
                            <v-btn text color="primary" class="pa-0" @click="toLogin()">login</v-btn>
                        </v-col>
                    </v-row>
                    <!-- <input type="hidden" name="event_id" :value="eventId"> -->
                    
                </v-form>
            </v-col>
        </v-row>
    </v-container>

</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
    data: function(){
        return{
            first_name: '',
            firstnameRules: [
                v => !!v || 'First Name is required',
            ],
            last_name: '',
            lastnameRules: [
                v => !!v || 'Last Name is required',
            ],
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
            password_confirmation: '',
            confirmPasswordRules: [
                (v) => !!v || 'Confirmation Password is required',
                (v) => v == this.password || 'Password must match'
            ],      
            timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
            showPassword: false,
            showPassword2: false
        }
    },
    computed: {
        ...mapState('student', [
            'allRegisterError'
        ])
    },
    methods: {
        ...mapActions('student', [
            'register'
        ]),
        goRegister(){    
            this.register({
                url: "/student/register",
                first_name: this.first_name,
                last_name: this.last_name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
                timezone: this.timezone
            })
        }, 
        toLogin(){
            this.$router.push({name: 'student-login'});
        }
    }


}
</script>

<style>

</style>