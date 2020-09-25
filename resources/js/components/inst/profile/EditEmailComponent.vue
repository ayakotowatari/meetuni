<template>
    <div>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="6">
                <h2 class="grey--text text--darken-1">Email</h2>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="4">
                <h4>{{ user.email }}</h4>
            </v-col>
            <v-col cols="12" sm="12" md="1" offset-md="1">
                <v-btn
                    color="primary"
                    outlined
                    @click="setIsEditing"
                >Edit</v-btn>
            </v-col>
        </v-row>
        <v-form v-if="isEditing" ref="form">
            <v-row justify="center">
                <v-col cols="12" sm="12" md="6">
                    <v-text-field
                        v-model="editedEmail"
                        label="Email" 
                        outlined
                        required
                        :rules="emailRules"
                        :error="allerror.email"
                        :error-messages="allerror.email"
                    ></v-text-field>
                </v-col>
            </v-row>
             <v-row justify="center">
                <v-col cols="12" sm="12" md="6">
                    <v-text-field
                        label="Confirm Email" 
                        outlined
                        required
                        :rules="confirmEmailRules"
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
            emailRules: [
                (v) => !!v || 'E-mail is required',
                (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
            ],
            confirmEmail: '',
            confirmEmailRules: [
                (v) => !!v || 'Confirmation E-mail is required',
                (v) => v == this.editedEmail || 'E-mail must match'
            ],
        }
    },
    computed: {
        ...mapState([
            'loading',
            'isEditing',
            'allerror',
        ]),
        editedEmail: {
            get(){
                return this.user.email
            },
            set (value) {
                this.$store.commit('updateEmail', value)
            }
        },
    },
    methods: {
        ...mapMutations({
            setIsEditing: 'setIsEditing',
            hasFinishedEditing: 'hasFinishedEditing'
        }),
        ...mapActions([
            'updateEmail'
        ]),
        save(){
            if(this.$refs.form.validate()){

                this.updateEmail({
                    email: this.editedEmail,
                })  
            }
        },
    }

}
</script>

<style>

</style>