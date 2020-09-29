<template>
    <v-col cols="12" sm="12" md="4">
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
                class="white--text font-weight-bold display-1"
            ><span class="h1">{{ eventQuestionsNumber }}</span></v-list-item-avatar>
            </v-list-item>

            <v-card-actions>
                <v-btn text @click="toEventQuestions">Details</v-btn>
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
        this.$store.dispatch('chart/fetchEventQuestionsNumber', {
            id: this.id
        })
    },
    computed: {
        ...mapState('chart', [
            'eventQuestionsNumber'
        ])
    },
    methods: {
        toEventQuestions(){
            this.$router.push({name: 'event-questions', params: {id: this.id}})
        }
    }

}
</script>

<style>

</style>