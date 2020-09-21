<template>
    <v-container>
        <h1 class="grey--text">My Team</h1>
        <v-btn 
            color="primary"
            outlined
            class='mt-8'
            @click="toAddMembers"
        >Add New Members</v-btn>
        <memberslist-component
            v-bind:user="user"
            v-bind:inst="inst"
        ></memberslist-component>
    </v-container>
</template>

<script>
import MembersList from './MembersListComponent'

export default {
    components: {
        MembersList
    },
    props: {
        user: Object,
        inst: Object,
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