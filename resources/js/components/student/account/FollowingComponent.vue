<template>
    <div>
        <v-container>
            <h1 class="mb-8 info--text">Following</h1>
            <v-card flat v-for="inst in followedInsts" :key="inst.id">
                <v-row class="pa-3"> 
                    <v-col cols="12" xs="12" md="2">
                        <v-img :src="`/storage/${ inst.image }`"></v-img>
                    </v-col>
                    <v-col cols="12" xs="12" md="2">
                        <div class="caption grey--text">Institution Name</div>
                        <div>{{ inst.name }}</div>
                    </v-col>
                    <v-col cols="12" xs="12" md="2">
                        <div class="caption grey--text">Country</div>
                        <div>{{ event.title }}</div>
                    </v-col>
                    <v-col cols="2" xs="6" sm="2" md="1">
                        <div class="mt-md-10">
                        <v-icon class="icon" color="error" @click="unlike(`${event.id}`)">mdi-heart</v-icon>
                        </div>
                    </v-col>
                    <v-col cols="2" xs="6" sm="2" md="1">
                        <div class="mt-md-10">
                        <v-btn color="primary" outlined @click="toEventList(`${inst.id}`)">Events list</v-btn>
                        </div>
                    </v-col>
                </v-row>
                <v-divider></v-divider>
            </v-card>
        </v-container>
    </div>
</template>

<script>
import moment from 'moment-timezone'

import BookingDialog from '../events/BookingDialogComponent'

import { mapState, mapActions } from "vuex"

export default {
    components: {
        BookingDialog
    },
    props: {
        user: Object,
    },
    data: function(){
        return{
            id: this.$route.params.id,
        }
    },
    mounted(){
        this.$store.dispatch('studentaccount/fetchLikedEvents', {
            id: this.id,
        })
    },
    computed: {
        ...mapState('studentaccount', [
            'likedEvents',
            'dialog',
            'isBooked',
        ]),
    },
    methods: {
        // ...mapMutations('studentaccount', {
        //     showDialog: 'showDialog'
        // }),
        ...mapActions('studentaccount',[
            'showDialogWithEvent'
        ]),
        showDialog(id){
            this.showDialogWithEvent({
                id: id
            })
        },
        toEventPage(id){
            this.$router.push({name: 'event-page', params: {id: id}})
        },
        formattedDate(value, timezone){
            return moment.utc(value).local().tz(timezone).format("ddd, MMM Do YYYY")
        },
        formattedStartTime(value, timezone){
            return moment.utc(value).local().tz(timezone).format("h:mm a")
        },
        formattedEndTime(value, timezone){
            return moment.utc(value).local().tz(timezone).format("h:mm a ([GMT] Z)")
        },
    }
}
</script>

<style>
.icon{
    display:inline-block;
}

</style>