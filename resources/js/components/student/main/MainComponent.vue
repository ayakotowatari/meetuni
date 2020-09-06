<template>
    <v-container>
        <v-row class="mt-4 mb-6">
            <v-col col="12" sm="12" md="8">
                <h1 class="topline primary--text">Looking for <br class="sm"> study opportunities <br class="md"> across the world ?</h1>
                <h3 class="subline grey--text">Find online university <br class="sm">information sessions <br> and taster lectures.</h3>
            </v-col>
        </v-row>
        <v-row>
            <v-col col="12" sm="12" md="6">
                <search-component></search-component>
            </v-col>
        </v-row>
        <v-tabs class="mb-6">
            <v-tab :to="{name: 'all-events'}">All</v-tab>
            <v-tab :to="{name: 'recommended-events', params: {id: this.user.id}}">For You</v-tab>
            <v-tab>Item Three</v-tab>
        </v-tabs>
        <router-view v-bind:user="user"></router-view>
    </v-container>
  
</template>

<script>
import SearchComponent from '../parts/SearchComponent'

export default {
    components: {
        SearchComponent
    },
    props: {
        user: Object,
    }

}
</script>

<style scoped>
.topline{
    font-size: 48px;
    line-height: 1.2em;
    margin-bottom: 0.5em;
}
.subline{
    font-size: 24px;
}
.sm{
    display:none;
}

@media(max-width:780px){
    .topline{
        font-size: 36px;
    }
    .md{
        display:none;
    }
    .sm{
        display:block;
    }
}

</style>