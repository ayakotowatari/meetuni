<template>
    <v-container>
        <h1 class="grey--text">My Team</h1>
        <v-btn 
            color="primary"
            outlined
            class='mt-8'
            @click="toAddMembers"
        >Add New Members</v-btn>
    </v-container>
</template>

<script>
export default {
    props: {
        user: Object
    },
    methods: {
        toAddMembers(){
            this.$router.push({name: 'add-members'})
        }
    }

}
</script>

<style>

</style>