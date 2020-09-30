<template>
    <v-form>
         <v-row justify="center" class="mt-10">
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
                <v-btn text color="primary" class="pa-0" @click="toRegister()">register</v-btn>
            </v-col>
        </v-row>
        <!-- <input type="hidden" name="event_id" :value="eventId"> -->
        
    </v-form>

</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
    data: function(){
        return{
            email: '',
            password: '',
        }
    },
    methods: {
        ...mapActions('student', [
            'login'
        ]),
        goLogin(){    
            this.login({
                url: "/student/login",
                email: this.email,
                password: this.password,
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