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
                    v-if="!isEditingForTimezone"
                    color="primary"
                    outlined
                    @click="setIsEditing"
                >Edit</v-btn>
            </v-col>
        </v-row>
        <v-form v-if="isEditingForTimezone" ref="form">
            <v-row justify="center">
                <v-col cols="12" sm="12" md="6">
                    <v-select
                        v-model="selectedTimezone"
                        :items="timezones"
                        item-value='zone'
                        label="Timezones"
                        outlined
                        :rules="timezoneRules" 
                        required
                        :error="allerror.timezones"
                        :error-messages="allerror.timezones"
                    >
                    <template v-slot:selection="data">
                        {{ data.item.zone }} ({{ data.item.GMT_difference }}) 
                    </template>
                     <template v-slot:item="data">
                         {{ data.item.zone }} ({{ data.item.GMT_difference }})
                    </template>
                    </v-select>
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col cols="12" sm="12" md="6" class="py-0">
                    <v-btn 
                        depressed 
                        color="primary" 
                        @click="save"
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
import { mapState, mapMutations, mapActions } from 'vuex'

export default {
    props: {
        user: Object
    },
    data: function(){
        return{
            selectedTimezone: '',
            timezoneRules: [
                v => !!v || 'Timezone is required',
            ],
        }
    },
    mounted(){
        this.$store.dispatch('getTimezoneList');
    },
    computed: {
        ...mapState([
            'timezones',
            'isEditingForTimezone',
            'loading',
            'allerror'
        ])
    },
    methods: {
        ...mapMutations({
            setIsEditing: 'setIsEditingForTimezone',
            hasFinishedEditing: 'hasFinishedEditingForTimezone'
        }),
        ...mapActions([
            'updateTimezone',
        ]),
        save(){
            if(this.$refs.form.validate()){

                this.updateTimezone({
                    timezone: this.selectedTimezone
                })
            }
        }
    }

}
</script>

<style>

</style>