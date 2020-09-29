<template>
    <v-col cols="12" sm="12" md="4">
        <v-card
            class="mx-auto"
            max-width="344"
            outlined
        >
            <v-list-item three-line>
            <v-list-item-content>
                <v-list-item-title class="headline mb-1">Bookings</v-list-item-title>
                <v-list-item-subtitle>Greyhound divisely hello coldly fonwderfully</v-list-item-subtitle>
            </v-list-item-content>

            <v-list-item-avatar
                size="80"
                color="info"
                class="white--text font-weight-bold display-1"
            ><span class="h1">{{ eventBookingsNumber }}</span></v-list-item-avatar>
            </v-list-item>

            <v-card-actions>
            <v-btn text>Manage Participants</v-btn>
            </v-card-actions>
        </v-card>
</v-col>
</template>

<script>
import { mapState } from 'vuex'

export default {
    props: {
        id: String
    },
    mounted(){
        this.$store.dispatch('chart/fetchEventBookingsNumber', {
            id: this.id
        })
    },
    computed: {
        ...mapState('chart', [
            'eventBookingsNumber'
        ])
    }

}
</script>

<style>

</style>