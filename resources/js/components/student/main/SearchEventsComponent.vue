<template>
    <v-row>
        <v-col cols="12" sm="12" md="4"> 
            <v-text-field
                v-model="term"
                outlined
                label="Search"
                append-icon="mdi-magnify"
                v-on:keyup.enter="search"
            ></v-text-field>
            <!-- <v-btn
                @click="search"
            >Search</v-btn> -->
        </v-col>
        <!-- <div v-for="result in results" :key="result.id">
            {{ result.title }}
            {{ result.description}}
        </div> -->
    </v-row>
</template>

<script>
export default {
    data: () => ({
        term: '',
        results: [],
    }),
    methods: {
        search(){

            axios 
                .post('/student/search-event',{
                    term: this.term
                })
                .then(response => {
                    this.results = response.data.results
                    this.$router.push({name: 'search-result'})
                })

        }
    }

}
</script>

<style>

</style>