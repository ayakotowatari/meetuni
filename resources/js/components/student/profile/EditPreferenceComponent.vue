<template>
    <div>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="6">
                <h2 class="grey--text text--darken-1">Destinations</h2>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col col="12" sm="12" md="8">
                <v-select
                    v-model="editedDestinations"
                    :items="countries"
                    item-text="region"
                    item-value='id'
                    label="Regions"
                    outlined
                    :rules="regionRules" 
                    multiple
                    chips
                    prepend-icon="mdi-globe-model"
                    hint="What are target regions?"
                    persistent-hint
                    required
                    :error="allerror.regions"
                    :error-messages="allerror.regions"
                ></v-select>
            </v-col>
        </v-row>


    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>