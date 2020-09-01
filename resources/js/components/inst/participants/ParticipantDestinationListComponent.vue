<template>
  <v-data-table dense :headers="headers" :items="destinations" item-key="country" class="elevation-1"></v-data-table>
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
                text: 'Country Name',
                align: 'start',
                sortable: true,
                value: 'country',
            },
            { text: 'Total', value: 'total', sortable: true },
            ],
            allerror: []
        }
    },
    mounted(){
        this.$store.dispatch('participantcharts/fillParticipantDestinationChart', {
            id: this.id
        })
    },
    method: {
        // async fetchCountryList(id){
        //      await axios
        //         .get('/inst/participant-destinations/' + this.id)
        //         .then(response => {
        //     
        //             console.log(response);

        //             this.destinations = response.data.destinations;
                    
        //         })
        //         .catch(error => {
        //         console.error(error);
        //         })
        //         // .finally(() => this.loaded = true)
        // },

    },
    computed: {
        ...mapState([
            'destinations'
        ])
    }
}
</script>

<style>

</style>