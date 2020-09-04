<template>
    <div>
        <v-container>
            <v-row class="mb-8">
                <h1 class="grey--text mb-6">Help us find best opportunities for you</h1>
            </v-row>
            <v-stepper v-model="e6" vertical>
                <v-stepper-step editable :complete="e6 > 1" step="1">
                Which country are you from?
                <!-- <small>Summarize if needed</small> -->
                </v-stepper-step>

                <v-stepper-content step="1" class="mb-6">
                    <v-select
                        v-model="selectedRegion"
                        :items="regions"
                        item-text="region"
                        item-value="id"
                        label="Select Your Regions"
                        chips
                        hint="which region are you in?"
                        persistent-hint
                        class="mb-4"
                    ></v-select>
                    <v-card height="100px" class="mb-4">
                        <v-chip-group 
                            v-model="country" 
                            column 
                            active-class="primary--text text--accent-4"
                            mandatory
                        >
                            <v-chip v-for="country in filteredCountries" :key="country.country">{{ country.country}}</v-chip>
                        </v-chip-group>
                    </v-card>
                    <v-btn color="primary" @click="e6 = 2">Continue</v-btn>
                </v-stepper-content>

                <v-stepper-step editable :complete="e6 > 2" step="2">
                Which year are you interested in starting your study overseas?
                </v-stepper-step>

                <v-stepper-content step="2" class="mb-6">
                    <v-card height="100px" class="mb-4">
                        <v-chip-group 
                            v-model="year" 
                            column 
                            active-class="primary--text text--accent-4"
                            multiple
                            mandatory
                        >
                            <v-chip v-for="year in years" :key="year.year">{{ year.year}}</v-chip>
                        </v-chip-group>
                    </v-card>
                <v-btn color="primary" @click="e6 = 3">Continue</v-btn>
                </v-stepper-content>

                <v-stepper-step editable :complete="e6 > 3" step="3">
                Which destinations of study are you interested in?
                </v-stepper-step>

                <v-stepper-content step="3" class="mb-6">
                    <v-card height="100px" class="mb-4">
                        <v-chip-group 
                            v-model="destination" 
                            column 
                            active-class="primary--text text--accent-4"
                            multiple
                            mandatory
                        >
                            <v-chip v-for="destination in destinations" :key="destination.country">{{ destination.country}}</v-chip>
                        </v-chip-group>
                    </v-card>
                <v-btn color="primary" @click="e6 = 5">Continue</v-btn>
                </v-stepper-content>

                <v-stepper-step editable :complete="e6 > 5" step="5">
                Which levels of study are you interested in?
                </v-stepper-step>

                <v-stepper-content step="5" class="mb-6">
                    <v-card height="100px" class="mb-4">
                        <v-chip-group 
                            v-model="level" 
                            column 
                            active-class="primary--text text--accent-4"
                            multiple
                            mandatory
                        >
                            <v-chip v-for="level in levels" :key="level.level">{{ level.level}}</v-chip>
                        </v-chip-group>
                    </v-card>
                <v-btn color="primary" @click="e6 = 5">Continue</v-btn>
                </v-stepper-content>

                <v-stepper-step editable step="5">
                Which subject areas are you insterested in?
                </v-stepper-step>
                <v-stepper-content step="5">
                    <v-card height="200px" class="mb-4">
                        <v-chip-group 
                            v-model="subject" 
                            column 
                            active-class="primary--text text--accent-4"
                            multiple
                            mandatory
                        >
                            <v-chip v-for="subject in subjects" :key="subject.subject">{{ subject.subject }}</v-chip>
                        </v-chip-group>
                    </v-card>
                <v-btn color="primary" @click="e6 = 1">Continue</v-btn>
                </v-stepper-content>
            </v-stepper>
        </v-container>
    </div>
</template>

<script>
import { mapState, mapGetters } from 'vuex'

export default {
    data: () => ({
        country: [],
        year: [],
        selectedRegion: [],
        destination: [],
        level: [],
        subject: [],
        e6: 1,
    }),
    mounted(){
        this.$store.dispatch('fetchRegions');
        this.$store.dispatch('fetchCountries');
        this.$store.dispatch('fetchYears');
        this.$store.dispatch('fetchDestinations');
        this.$store.dispatch('fetchLevels');
        this.$store.dispatch('fetchSubjects');
    },
    computed: {
        ...mapState([
            'regions',
            'countries',
            'years',
            'destinations',
            'levels',
            'subjects'
        ]),
        ...mapGetters([
            'filterCountries'
        ]),
        filteredCountries(){
            return this.filterCountries(this.selectedRegion);
        }
        // filteredCountries(){
        //     let options = this.countries
        //     return options.filter(option => option.region_id == this.selectedRegion)
        // }
    },



}
</script>

<style>

</style>