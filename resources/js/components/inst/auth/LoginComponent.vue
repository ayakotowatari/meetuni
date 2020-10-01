<template>
    <div>
    <v-app>
        <homenavbar-component></homenavbar-component>
        <v-main>
             <v-row justify="center">
                <v-col cols="12" sm="12" md="3">
                    <h2 class="grey--text text--darken-2">Institution Login</h2>
                </v-col>
            </v-row>
            <v-form>
                <v-row justify="center">
                    <v-col cols="12" sm="12" md="3">
                        <v-text-field
                            v-model="email"
                            label="Email" 
                            outlined
                            required
                        ></v-text-field>
                        <v-text-field 
                            v-model="password"
                            label="Password" 
                            outlined
                            required
                        ></v-text-field>
                        <v-btn block depressed dark color="primary" class="mb-2" @click="goLogin()">Login</v-btn>
                    </v-col>
                </v-row>
                <!-- <input type="hidden" name="event_id" :value="eventId"> -->
            </v-form>
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
        }
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