<template>
    <div>
        <v-row>
            <testtwo-component v-bind:dialog="dialog"></testtwo-component>
        </v-row>
        <v-row>
            <v-btn @click.stop="showDialog">Book</v-btn>
        </v-row>
    </div>
</template>   

<script>
import TestTwo from './TestTwoComponent'

import { mapState, mapMutations } from 'vuex'

// import {createNamespacedHelpers} from 'vuex'
// const { mapState, mapMutations } = createNamespacedHelpers('student');

export default {
    components: {
        TestTwo
    },
    computed: {
        ...mapState('student', [
            'dialog'
        ])
    },
    methods: {
        ...mapMutations('student', {
            showDialog: 'showDialog'
        }),
    }
}
</script>

<style>

</style>