<template>
    <v-row class="mb-10">
        <bookingsnumber-component
            v-bind:id="id"
        ></bookingsnumber-component>
        <v-col col="12" sm="12" md="4">
            <v-card
                class="mx-auto"
                max-width="344"
                outlined
            >
                <v-list-item three-line>
                <v-list-item-content>
                    <v-list-item-title class="headline mb-1">Likes</v-list-item-title>
                    <v-list-item-subtitle>Greyhound divisely hello coldly fonwderfully</v-list-item-subtitle>
                </v-list-item-content>

                <v-list-item-avatar
                    size="80"
                    color="info"
                ></v-list-item-avatar>
                </v-list-item>

                <v-card-actions>
                <v-btn text>Button</v-btn>
                <v-btn text>Button</v-btn>
                </v-card-actions>
            </v-card>
        </v-col>
        <v-col col="12" sm="12" md="4">
            <v-card
                class="mx-auto"
                max-width="344"
                outlined
            >
                <v-list-item three-line>
                <v-list-item-content>
                    <v-list-item-title class="headline mb-1">Questions</v-list-item-title>
                    <v-list-item-subtitle>Greyhound divisely hello coldly fonwderfully</v-list-item-subtitle>
                </v-list-item-content>

                <v-list-item-avatar
                    size="80"
                    color="info"
                ></v-list-item-avatar>
                </v-list-item>

                <v-card-actions>
                <v-btn text>Details</v-btn>
                </v-card-actions>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
import BookingsNumber from './DashboardChartComponent'

export default {
    components: {
        BookingsNumber
    },
    props: {
        id: String
    }
   
}
</script>

<style>

</style>