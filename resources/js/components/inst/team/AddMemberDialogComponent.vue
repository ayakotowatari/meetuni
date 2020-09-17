<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" persistent max-width="290">
            <v-card>
                <v-card-title class="headline">Adding a new member?</v-card-title>
                <v-card-text>By clicking Confirm, this new member will be registered.</v-card-text>
                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="info darken-1" text @click="cancel">Confirm</v-btn>
                <v-btn color="grey" text @click="close">Not Now</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
export default {

}
</script>

<style>

</style>