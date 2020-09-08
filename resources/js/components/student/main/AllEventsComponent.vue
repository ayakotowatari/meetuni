<template>
<v-container>
    <v-row>
        <v-col col="12" sm="12" md="3" class="mb-6" v-for="event in allEvents" :key="event.id">
            <v-card
                class="mx-auto card-link"
                max-width="400"
                @click.stop="expand(event.id)"
            >
                <v-img
                class="white--text align-end"
                height="180px"
                :src="`/storage/${ event.image }`"
                aspect-ratio="1.7"  
                >
                </v-img>

                <v-card-actions>
                    <v-list-item class="grow">
                        <v-list-item-avatar color="grey darken-3">
                        <v-img
                            class="elevation-6"
                            src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=White&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Light"
                        ></v-img>
                        </v-list-item-avatar>

                        <v-row
                        align="center"
                        justify="end"
                        >
                        <v-icon class="mr-3">mdi-heart</v-icon>
                        <v-icon class="mr-1">mdi-share-variant</v-icon>
                        </v-row>
                    </v-list-item>
                </v-card-actions>

                <v-card-title>{{ event.name }}</v-card-title>

                <v-card-subtitle class="pb-0">
                    {{ formattedDate(event.date, user.timezone) }} <br> 
                    {{ formattedStartTime(event.start_utc, user.timezone) }}  -  
                    {{ formattedEndTime(event.end_utc, user.timezone) }}
                </v-card-subtitle>

                <v-card-text class="text--primary">
                <div>{{ event.title }}</div>
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
</v-container>
</template>

<script>
import moment from 'moment-timezone'

import { mapState } from 'vuex'
// import {createNamespacedHelpers} from 'vuex'
// const { mapState } = createNamespacedHelpers('student');

export default {
    props: {
        user: Object,
    },
    data: () => ({

    }),
    mounted(){
        this.$store.dispatch('student/fetchAllEvents');
    },
    computed: {
        ...mapState('student', [
            'allEvents',
        ])
    },
    methods: {
        expand(id){
            this.$router.push({name: 'event-details', params: {id: id}})
        },
        formattedDate(value, timezone){
            return moment.utc(value).local().tz(timezone).format("ddd, MMM Do YYYY")
        },
        formattedStartTime(value, timezone){
            return moment.utc(value).local().tz(timezone).format("h:mm a")
        },
        formattedEndTime(value, timezone){
            return moment.utc(value).local().tz(timezone).format("h:mm a ([GMT] Z)")
        }
    }
}
</script>

<style>
.card-link{
    cursor: pointer;
}

</style>