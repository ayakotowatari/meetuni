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
                <v-btn block dark color="info darken-3" class="mb-2" @click="login()">Login</v-btn>
                <v-btn text color="info darken-3" class="pa-0" @click="toRegister()">register</v-btn>
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
            event_id: this.$route.params.id,
            email: '',
            password: '',
        }
    },
    methods: {
        ...mapActions('student', [
            'loginToLike'
        ]),
        login(){    
            console.log('check');
            console.log(this.event_id);

            // let data = {
            //     email: this.email,
            //     password: this.password,
            //     event_id: this.event_id
            // }

            this.loginToLike({
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