<template>
  <v-data-table dense :headers="headers" :items="countries" item-key="country" class="elevation-1"></v-data-table>
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
        this.$store.dispatch('participantcharts/fillParticipantCountryChart', {
            id: this.id
        })
    },
    method: {
        // async fetchCountryList(id){
        //      await axios
        //         .get('/inst/participant-countries/' + this.id)
        //         .then(response => {
        //             // console.log(response.data.country);
        //             // console.log(response.data.total);

        //             console.log(response);

        //             this.countries = response.data.countries;
                    
        //         })
        //         .catch(error => {
        //         console.error(error);
        //         })
        //         // .finally(() => this.loaded = true)
        // },

    },
    computed: {
        ...mapState([
            'countries'
        ])
    }
}
</script>

<style>

</style>