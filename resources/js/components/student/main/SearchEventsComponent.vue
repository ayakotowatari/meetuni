<template>
  <v-container> 
    <v-text-field
        v-model="term"
    ></v-text-field>
    <v-btn
        @click="search"
    >Search</v-btn>

    <div v-for="result in results" :key="result.id">
        {{ result.title }}
        {{ result.description}}
    </div>
      
  </v-container>
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
                })

        }
    }

}
</script>

<style>

</style>