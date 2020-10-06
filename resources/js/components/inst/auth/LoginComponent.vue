<template>
    <div>
    <v-app>
        <homenavbar-component></homenavbar-component>
        <v-main>
            <v-container>
            <v-row justify="center">
                <v-col cols="12" sm="12" md="8">
                    <h2 class="grey--text text--darken-2">Institution Login</h2>
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col cols="12" sm="12" md="4">
                    <v-img 
                        src="https://meetuni.s3-ap-northeast-1.amazonaws.com/illustration/character+7.svg" 
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
                                ></v-text-field>
                                <v-text-field 
                                    v-model="password"
                                    label="Password" 
                                    :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                    :type="showPassword ? 'text' : 'password'"
                                    outlined
                                    required
                                    @click:append="showPassword = !showPassword"
                                ></v-text-field>
                                <v-btn block depressed dark color="primary" class="mb-2" @click="goLogin()">Login</v-btn>
                            </v-col>
                        </v-row>
                        <!-- <input type="hidden" name="event_id" :value="eventId"> -->
                    </v-form>
                </v-col>
            </v-row>
            </v-container>
        </v-main>
    </v-app>
    </div>
</template>

<script>
import HomeNavbar from '../parts/HomeNavbarComponent'

import { mapState, mapActions } from 'vuex'

export default {
    components: {
        HomeNavbar,
    },
    data: function(){
        return{
            email: '',
            password: '',
            showPassword: 'false',
        }
    },
    computed: {
        
    },
    methods: {
        ...mapActions([
            'login'
        ]),
        goLogin(){    
            this.login({
                url: "/inst/login",
                email: this.email,
                password: this.password,
            })
        },
    }


}
</script>

<style>

</style>