<template>
    <div>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="6">
                <h2 class="grey--text text--darken-1">Basic Information</h2>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="4">
                <h3>{{ user.first_name }} {{ user.last_name }}</h3>
            </v-col>
            <v-col cols="12" sm="12" md="1" offset-md="1">
                <v-btn
                    v-if="!isEditingForProfileBasics"
                    color="primary"
                    outlined
                    @click="setIsEditing"
                >Edit</v-btn>
            </v-col>
        </v-row>
        <v-form v-if="isEditingForProfileBasics" ref="form">
            <v-row justify="center">
                <v-col cols="12" sm="12" md="3">
                    <v-text-field
                        v-model="firstName"
                        label="First Name" 
                        outlined
                        required
                        :rules="firstnameRules"
                        :error="allerror.first_name"
                        :error-messages="allerror.first_name"
                    ></v-text-field>
                </v-col>
                <v-col cols="12" sm="12" md="3">
                    <v-text-field
                        v-model="lastName"
                        label="Last Name" 
                        outlined
                        required
                        :rules="lastnameRules"
                        :error="allerror.last_name"
                        :error-messages="allerror.last_name"
                    ></v-text-field>
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
import { mapState, mapMutations, mapActions } from 'vuex'

export default {
    props: {
        user: Object
    },
    data: function(){
        return{
            firstnameRules: [
                v => !!v || 'First Name is required',
            ],
            lastnameRules: [
                v => !!v || 'Last Name is required',
            ],
        }
    },
    computed: {
        ...mapState('student', [
            'isEditingForProfileBasics',
            'loading',
            'allerror',
        ]),
        firstName: {
            get(){
                return this.user.first_name
            },
            set (value) {
                this.$store.commit('student/updateFirstName', value)
            }
        },
        lastName: {
            get(){
                return this.user.last_name
            },
            set (value) {
                this.$store.commit('student/updateLastName', value)
            }
        },
    },
    methods: {
        ...mapMutations('student', {
            setIsEditing: 'setIsEditingForProfileBasics',
            hasFinishedEditing: 'hasFinishedEditingForProfileBasics'
        }),
        ...mapActions('student', [
            'updateProfileBasics'
        ]),
        save(){
            if(this.$refs.form.validate()){

                this.updateProfileBasics({
                    first_name: this.firstName,
                    last_name: this.lastName,
                })

            }
        },
    }

}
</script>

<style>

</style>