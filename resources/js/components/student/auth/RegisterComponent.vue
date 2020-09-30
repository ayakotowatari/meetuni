<template>
    <v-form>
         <v-row justify="center" class="mt-10">
            <v-col cols="12" sm="12" md="3">
                <v-text-field
                    v-model="first_name"
                    label="First Name" 
                    outlined
                    required
                ></v-text-field>
                <v-text-field
                    v-model="last_name"
                    label="Last Name" 
                    outlined
                    required
                ></v-text-field>
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
                <v-text-field 
                    v-model="password_confirmation"
                    label="Confirm Password" 
                    outlined
                    required
                ></v-text-field>

                 <input type="hidden" name="timezone" :value="timezone">

                <v-btn block dark color="info darken-3" class="mb-2" @click="goRegister()">register</v-btn>
                <v-btn text color="info darken-3" class="pa-0" @click="toLogin()">login</v-btn>
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
            first_name: '',
            last_name: '',
            email: '',
            password: '',
            password_confirmation: '',
            timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
        }
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