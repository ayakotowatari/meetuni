<template>
    <v-row class="mb-10">
        <bookingsnumber-component
            v-bind:id="id"
        ></bookingsnumber-component>
        <likesnumber-component
            v-bind:id="id"
        ></likesnumber-component>
        <questionsnumber-component
            v-bind:id="id"
        ></questionsnumber-component>
    </v-row>
</template>

<script>
import BookingsNumber from './BookingsNumberComponent'
import LikesNumber from './LikesNumberComponent'
import QuestionsNumber from './QuestionsNumberComponent'

export default {
    components: {
        BookingsNumber,
        LikesNumber,
        QuestionsNumber
    },
    props: {
        id: Number
    }
   
}
</script>

<style>

</style>