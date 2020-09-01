<template>
  <v-data-table dense :headers="headers" :items="subjects" item-key="subject" class="elevation-1"></v-data-table>
</template>

<script>
import {createNamespacedHelpers} from 'vuex'
const {mapState} = createNamespacedHelpers('participantcharts');

export default {
    props: {
        id: String
    },
    data: () => {
        return {
            // countries: [],
            headers: [
            {
                text: 'Subjects',
                align: 'start',
                sortable: true,
                value: 'subject',
            },
            { text: 'Total', value: 'total', sortable: true },
            ],
            allerror: []
        }
    },
    mounted(){
        this.$store.dispatch('participantcharts/fillParticipantSubjectChart', {
            id: this.id
        })
    },
    method: {

    },
    computed: {
        ...mapState([
            'subjects'
        ])
    }
}
</script>

<style>

</style>