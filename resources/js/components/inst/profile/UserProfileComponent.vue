<template>
    <v-container>
        <h1 class="subheading grey--text">My Profile</h1>
        <editbasicprofile-component
            v-bind:user="user"
            class="mb-10"
        ></editbasicprofile-component>
        <edit-email
            v-bind:user="user"
            class="mb-10"
        ></edit-email>
        <editpassword-component
            v-bind:user="user"
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