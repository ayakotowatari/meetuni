<template>
    <div>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="6">
                <h2 class="grey--text text--darken-1">Timezone</h2>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="4">
                <h4>{{ user.timezone }}</h4>
            </v-col>
            <v-col cols="12" sm="12" md="1" offset-md="1">
                <v-btn
                    v-if="!isEditing"
                    color="primary"
                    outlined
                    @click="setIsEditing"
                >Edit</v-btn>
            </v-col>
        </v-row>
        <v-form v-if="isEditing" ref="form">
            <v-row justify="center">
                <v-col cols="12" sm="12" md="6">
                    <v-select
                        v-model="selectedTimezone"
                        :items="timezones"
                        item-text="timezone"
                        item-value='id'
                        label="Timezones"
                        outlined
                        :rules="timezoneRules" 
                        required
                        :error="allerror.timezones"
                        :error-messages="allerror.timezones"
                    ></v-select>
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col col="12" sm="12" md="6" class="py-0">
                    <v-btn 
                        depressed 
                        color="primary" 
                        @click="save"
                        :loading="loading"
                    >Save
                    </v-btn>
                    <v-btn 
                        color="primary" 
                        outlined
                        class="ml-4" 
                        @click="hasFinishedEditing"
                    >Cancel
                    </v-btn>
                </v-col>
            </v-row>
        </v-form>
    </div>
</template>

<script>
import { mapMutations } from 'vuex'

export default {
    props: {
        user: Object
    },
    methods: {
        ...mapMutations('timezone', {
            setIsEditing: 'setIsEditing',
            hasFinishedEditing: 'hasFinishedEditing'
        })
    }

}
</script>

<style>

</style>