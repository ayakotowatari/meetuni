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
                            v-model="selectedCountry" 
                            column 
                            active-class="primary--text text--accent-4"
                            mandatory
                        >
                            <v-chip v-for="country in filteredCountries" :key="country.id" :value="`${country.id}`">{{ country.country }}</v-chip>
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
                            v-model="selectedYear" 
                            column 
                            active-class="primary--text text--accent-4"
                            mandatory
                        >
                            <v-chip v-for="year in years" :key="year.year" :value="`${year.id}`">{{ year.year}}</v-chip>
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
                            v-model="selectedDestinations" 
                            column 
                            active-class="primary--text text--accent-4"
                            multiple
                            mandatory
                        >
                            <v-chip v-for="destination in destinations" :key="destination.country" :value="`${destination.id}`">{{ destination.country}}</v-chip>
                        </v-chip-group>
                    </v-card>
                <v-btn color="primary" @click="e6 = 4">Continue</v-btn>
                </v-stepper-content>

                <v-stepper-step editable :complete="e6 > 4" step="4">
                Which levels of study are you interested in?
                </v-stepper-step>

                <v-stepper-content step="4" class="mb-6">
                    <v-card height="100px" class="mb-4">
                        <v-chip-group 
                            v-model="selectedLevels" 
                            column 
                            active-class="primary--text text--accent-4"
                            multiple
                            mandatory
                        >
                            <v-chip v-for="level in levels" :key="level.level" :value="`${level.id}`">{{ level.level}}</v-chip>
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
                            v-model="selectedSubjects" 
                            column 
                            active-class="primary--text text--accent-4"
                            multiple
                            mandatory
                        >
                            <v-chip v-for="subject in subjects" :key="subject.subject" :value="`${subject.id}`">{{ subject.subject }}</v-chip>
                        </v-chip-group>
                    </v-card>
                <v-btn color="primary" @click.stop="submit">Save</v-btn>
                </v-stepper-content>
            </v-stepper>
        </v-container>
    </div>
</template>

<script>
import { mapState, mapGetters, mapActions } from 'vuex'

export default {
    props: {
        user: Object,
    },
    data: () => ({
        selectedRegion: [],
        selectedCountry: [],
        selectedYear: [],
        selectedDestinations: [],
        selectedLevels: [],
        selectedSubjects: [],
        e6: 1,
    }),
    mounted(){
        this.$store.dispatch('studentdetails/fetchRegions');
        this.$store.dispatch('studentdetails/fetchCountries');
        this.$store.dispatch('studentdetails/fetchYears');
        this.$store.dispatch('studentdetails/fetchDestinations');
        this.$store.dispatch('studentdetails/fetchLevels');
        this.$store.dispatch('studentdetails/fetchSubjects');
    },
    computed: {
        ...mapState('studentdetails', [
            'regions',
            'countries',
            'years',
            'destinations',
            'levels',
            'subjects', 
            'allerror'
        ]),
        ...mapGetters('studentdetails', [
            'filterCountries'
        ]),
        filteredCountries(){
            return this.filterCountries(this.selectedRegion);
        },
        // filteredCountries(){
        //     let options = this.countries
        //     return options.filter(option => option.region_id == this.selectedRegion)
        // }
    },
    methods: {
        ...mapActions('studentdetails', [
            'addStudentDetails'
        ]),
        submit(){

            // console.log(this.selectedCountry);
            // console.log(this.selectedYear);
            // console.log(this.selectedDestinations);
            // console.log(this.selectedLevels);
            // console.log(this.selectedSubjects);
        
            this.addStudentDetails({
                id: this.user.id,
                country: this.selectedCountry,
                year: this.selectedYear,
                destinations: this.selectedDestinations,
                levels: this.selectedLevels,
                subjects: this.selectedSubjects,
            })
            .then(() => {
                this.$router.push({path: '/student/main'});
            });
            
        },
    }



}
</script>

<style>

</style>