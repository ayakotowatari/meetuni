<template>
    <div>
        <v-container>
            <h1 class="mb-8 info--text">Following</h1>
            <v-card flat v-for="inst in followedInsts" :key="inst.id">
                <v-row class="pa-3" justify="center"> 
                    <!-- <v-col cols="12" xs="12" md="2">
                        <v-img :src="`/storage/${ inst.image }`"></v-img>
                    </v-col> -->
                    <v-col cols="12" xs="12" md="2">
                        <div class="caption grey--text">Institution Name</div>
                        <div>{{ inst.name }}</div>
                    </v-col>
                    <v-col cols="12" xs="12" md="2">
                        <div class="caption grey--text">Country</div>
                        <div>{{ inst.country }}</div>
                    </v-col>
                    <v-col cols="12" xs="6" sm="2" md="2">
                        <div class="mt-md-10">
                            <v-btn 
                                class="ma-2" 
                                color="primary" 
                                @click="toEventList(`${inst.id}`)"
                            >
                                <v-icon left>mdi-calendar-month-outline</v-icon>
                                Event List
                            </v-btn>
                        </div>
                    </v-col>
                    <v-col cols="12" xs="6" sm="2" md="2">
                        <div class="mt-md-10">
                            <v-btn 
                                v-if ="inst.followed_by_user == true"
                                color="primary" 
                                outlined 
                                class="ma-2" 
                                @click="unfollow(`${inst.id}`)"
                            >followed</v-btn>
                            <v-btn 
                                v-if ="inst.followed_by_user == false"
                                color="grey" 
                                outlined 
                                class="ma-2" 
                                @click="follow(`${inst.id}`)"
                            >unfollowed</v-btn>
                            </div>
                    </v-col>
                </v-row>
                <v-divider></v-divider>
            </v-card>
        </v-container>
    </div>
</template>

<script>
import { mapState, mapActions } from "vuex"

export default {
    components: {
        
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
        this.$store.dispatch('studentaccount/fetchFollowingInsts', {
            id: this.id,
        })
    },
    computed: {
        ...mapState('studentaccount', [
            'followedInsts',
            'dialog',
        ]),
    },
    methods: {
        // ...mapMutations('studentaccount', {
        //     showDialog: 'showDialog'
        // }),
        ...mapActions('studentaccount',[
            'unfollowInsts',
            'followInsts',
            'showDialogWithEvent'
        ]),
        unfollow(id){
            this.unfollowInsts({
                inst_id: id,
                user_id: this.user.id
            })
        },
        follow(id){
            this.followInsts({
                inst_id: id,
                user_id: this.user.id
            })
        },
        showDialog(id){
            this.showDialogWithEvent({
                id: id
            })
        },
        toEventPage(id){
            this.$router.push({name: 'event-page', params: {id: id}})
        },
    }
}
</script>

<style>
/* .icon{
    display:inline-block;
} */

</style>