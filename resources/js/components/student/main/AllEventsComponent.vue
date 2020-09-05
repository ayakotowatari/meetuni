<template>
<v-container>
    <v-row>
        <v-col col="12" sm="12" md="3" class="mb-6" v-for="allEvent in allEvents" :key="allEvent.id">
            <v-card
                class="mx-auto"
                max-width="400"
            >
                <v-img
                class="white--text align-end"
                height="180px"
                :src="`/storage/${ allEvent.image }`"
                aspect-ratio="1.7"  
                >
                </v-img>

                <v-card-title>{{ allEvent.name }}</v-card-title>

                <v-card-subtitle class="pb-0">Fri, Aug 29 2020 <br> 13:00 - 14:00 (GMT + 09:00)</v-card-subtitle>

                <v-card-text class="text--primary">
                <div>{{ allEvent.title }}</div>
                </v-card-text>

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
            </v-card>
        </v-col>
    </v-row>
</v-container>
</template>

<script>
// import { mapState } from 'vuex'
import {createNamespacedHelpers} from 'vuex'
const { mapState } = createNamespacedHelpers('student');

export default {
    data: () => ({

    }),
    mounted(){
        this.$store.dispatch('student/fetchAllEvents');
    },
    computed: {
        ...mapState([
            'allEvents',
        ])
    },


}
</script>

<style>

</style>