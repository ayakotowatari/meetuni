<template>
  <v-data-table dense :headers="headers" :items="levels" item-key="level" class="elevation-1"></v-data-table>
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
                text: 'Levels',
                align: 'start',
                sortable: true,
                value: 'level',
            },
            { text: 'Total', value: 'total', sortable: true },
            ],
            allerror: []
        }
    },
    mounted(){
        this.$store.dispatch('participantcharts/fillParticipantLevelChart', {
            id: this.id
        })
    },
    method: {

    },
    computed: {
        ...mapState([
            'levels'
        ])
    }
}
</script>

<style>

</style>