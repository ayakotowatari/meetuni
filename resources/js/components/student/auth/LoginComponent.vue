<template>
    <v-form>
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
        <!-- <input type="hidden" name="event_id" :value="eventId"> -->
        <v-btn @click="login(event_id)">Login</v-btn>
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
        login(id){    

            this.loginToLike({
                url: "/student/login",
                email: this.email,
                password: this.password,
                event_id: id
            })
            
        }
    }


}
</script>

<style>

</style>