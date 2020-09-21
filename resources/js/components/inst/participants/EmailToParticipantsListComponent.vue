<template>
    <v-data-table
        :headers="headers"
        :items="emails"
        class="elevation-1"
    >
    </v-data-table>
</template>

<script>
export default {
    props: {
        user: Object,
    },
    data: function(){
        return {
            id: this.$route.params.id,
        }
    },
    mounted(){
        this.$store.dispatch('notifications/fetchEmailsToParticipantsList', {
            id: this.id
        });
    }

}
</script>

<style>

</style>