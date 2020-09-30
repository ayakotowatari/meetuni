<template>
    <v-container>
        <v-row class="mt-4 mb-6">
            <v-col cols="12" sm="12" md="8">
                <h1 class="topline primary--text">Looking for <br class="sm"> study opportunities <br class="md"> across the world ?</h1>
                <h3 class="subline grey--text">Find online university <br class="sm">information sessions <br> and taster lectures.</h3>
            </v-col>
        </v-row>
        <v-tabs class="mb-12">
            <v-tab router :to="{name: 'all-events'}">All</v-tab>
            <v-tab router :to="{name: 'recommended-events'}">For You</v-tab>
            <v-tab router :to="{name: 'search-events'}">Search</v-tab>
        </v-tabs>
        <router-view 
            v-bind:user="user"
            v-bind:isLoggedIn="isLoggedIn"
        ></router-view>
    </v-container>
  
</template>

<script>
export default {
    props: {
        user: Object,
        isLoggedIn: Boolean
    },
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