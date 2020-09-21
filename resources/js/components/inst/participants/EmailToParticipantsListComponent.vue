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
        emails: Array,
    },
    data: function(){
        return {
            id: this.$route.params.id,
             headers: [
                {
                    text: 'Event Title',
                    align: 'start',
                    sortable: false,
                    value: 'title',
                },
                { text: 'Status', value: 'status' },
                { text: 'Scheduled Date', value: 'scheduled_date' },
                { text: 'Time', value: 'scheduled_time' },
                { text: 'Timezone', value: 'timezone' },
                { text: 'Schedule', value: 'schedule' },
                { text: 'Edit', value: 'edit' }
            ],
        }
    },
    mounted(){
       
    },
    computed: {
       
    }

}
</script>

<style>

</style>