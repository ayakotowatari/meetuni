<template>
    <v-container>
        <h1 class="subheading grey--text">My Profile</h1>
        <basicsreset-component
            v-bind:user="user"
        ></basicsreset-component>
        <passwordreset-component
            v-bind:user="user"
        ></passwordreset-component>

    </v-container>
</template>

<script>
// import moment from 'moment'
// import moment from 'moment-timezone'

import PasswordReset from './PasswordResetComponent'
import BasicsReset from './BasicsResetComponent'

export default {
    components: {
        BasicsReset,
        PasswordReset,

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