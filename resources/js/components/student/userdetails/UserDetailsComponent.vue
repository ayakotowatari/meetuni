<template>
    <div>
        <v-container>
            <v-row class="mb-8">
                <h1 class="grey--text mb-6">Tell us what you are looking for</h1>
            </v-row>
        <v-stepper v-model="e6" vertical>
            <v-stepper-step :complete="e6 > 1" step="1">
            Where are you from?
            <small>Summarize if needed</small>
            </v-stepper-step>

            <v-stepper-content step="1">
            <v-card color="grey lighten-1" class="mb-12" height="200px"></v-card>
            <v-btn color="primary" @click="e6 = 2">Continue</v-btn>
            <v-btn text>Cancel</v-btn>
            </v-stepper-content>

            <v-stepper-step :complete="e6 > 2" step="2">Configure analytics for this app</v-stepper-step>

            <v-stepper-content step="2">
            <v-card color="grey lighten-1" class="mb-12" height="200px"></v-card>
            <v-btn color="primary" @click="e6 = 3">Continue</v-btn>
            <v-btn text>Cancel</v-btn>
            </v-stepper-content>

            <v-stepper-step :complete="e6 > 3" step="3">Select an ad format and name ad unit</v-stepper-step>

            <v-stepper-content step="3">
            <v-card color="grey lighten-1" class="mb-12" height="200px"></v-card>
            <v-btn color="primary" @click="e6 = 4">Continue</v-btn>
            <v-btn text>Cancel</v-btn>
            </v-stepper-content>

            <v-stepper-step step="4">View setup instructions</v-stepper-step>
            <v-stepper-content step="4">
            <v-card color="grey lighten-1" class="mb-12" height="200px"></v-card>
            <v-btn color="primary" @click="e6 = 1">Continue</v-btn>
            <v-btn text>Cancel</v-btn>
            </v-stepper-content>
        </v-stepper>
                

        </v-container>
    </div>
</template>

<script>
export default {
    data: () => ({
        e6: 1,
    })

}
</script>

<style>

</style>