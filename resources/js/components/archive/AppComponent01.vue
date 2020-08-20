<template>
    <v-app>
        <navbar-component v-bind:user="user"></navbar-component>
        <router-view></router-view>
    </v-app>
</template>

<script>


export default {
    props:{
        user: Array,
    },
   data: () => ({

       user: '',

   })
    
       
       
}
</script>

<style>

</style>
