<template>
    <v-container>
        <h1 class="subheading grey--text">My Profile</h1>
        <editbasicprofile-component
            v-bind:user="user"
            class="mb-8"
        ></editbasicprofile-component>
        <v-row justify="center">
            <v-col col="12" sm="12" md="8">
                <v-divider></v-divider>
            </v-col>
        </v-row>
        <edit-email
            v-bind:user="user"
            class="mt-6 mb-8"
        ></edit-email>
        <v-row justify="center">
            <v-col col="12" sm="12" md="8">
                <v-divider></v-divider>
            </v-col>
        </v-row>
        <editpassword-component
            v-bind:user="user"
            class="mt-6 mb-8"
        ></editpassword-component>

    </v-container>
</template>

<script>
// import moment from 'moment'
// import moment from 'moment-timezone'

import EditPassword from './EditPasswordComponent'
import EditEmail from './EditEmailComponent'
import EditBasicProfile from './EditBasicProfileComponent'

export default {
    components: {
        EditPassword,
        EditEmail,
        EditBasicProfile,
    },
    props: {
        user: Object,
    },
    data: () => ({
       
    }),
    methods: {
        // formatDate(value){
        //     return moment.utc(value).local().format("ddd, MMM Do YYYY h:mm a Z")
        // },
        
    },
    computed:{
        // formatDate(value, timezone){
        //     return moment.utc(value).local().tz(timezone).format("ddd, MMM Do YYYY h:mm a ([GMT] Z)")
        // },
    }
}
</script>

<style>

</style>