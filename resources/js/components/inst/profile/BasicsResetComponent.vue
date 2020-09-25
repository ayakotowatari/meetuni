<template>
    <div>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="8">
                <h2 class="grey--text text--darken-1">Basic Information</h2>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="2">
                <p>{{ user.full_name }}</p>
            </v-col>
            <v-col cols="12" sm="12" md="6">

            </v-col>
        </v-row>
    </div>
</template>

<script>
export default {
    props: {
        user: Object
    }

}
</script>

<style>

</style>