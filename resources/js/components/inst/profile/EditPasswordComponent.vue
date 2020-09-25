<template>
    <div>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="6">
                <h2 class="grey--text text--darken-1">Password</h2>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="4">
                <h4>********</h4>
            </v-col>
            <v-col cols="12" sm="12" md="1" offset-md="1">
                <v-btn
                    color="primary"
                    outlined
                    @click="isEditing = !isEditing"
                >Edit</v-btn>
            </v-col>
        </v-row>
        <v-form v-if="isEditing" ref="form">
            <v-row justify="center">
                <v-col col="12" sm="12" md="6">
                        <v-text-field 
                            v-model="currentPassword"
                            label="Current Password" 
                            outlined
                            required
                            :error="allerror.currentPassword"
                            :error-messages="allerror.currentPassword"
                            name="current-password"
                        ></v-text-field>
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col col="12" sm="12" md="6">
                        <v-text-field 
                            label="New Password" 
                            v-model="newPassword" 
                            outlined
                            :rules="passwordRules" 
                            required
                            :error="allerror.newPassword"
                            :error-messages="allerror.newPassword"
                            name="newPassword"
                        ></v-text-field>
                </v-col>
            </v-row>
                <v-row justify="center">
                <v-col col="12" sm="12" md="6">
                        <v-text-field 
                            label="Confirm New Password" 
                            v-model="newPassword_confirmation"
                            outlined
                            :rules="confirmpasswordRules" 
                            required
                            name="newPassword_confirmation"
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
                        @click="isEditing = !isEditing"
                    >Cancel
                    </v-btn>
                </v-col>
            </v-row>
        </v-form>
    </div>
</template>

<script>
// import { mapState } from 'vuex'

export default {
    props: {
        user: Object,
    },
    data: function(){
        return {
            isEditing: false,
            currentPassword: '',
            passwordRules: [],
            newPassword: '',
            confirmpasswordRules: [],
            allerror: [],

        }
    },
    computed: {
    //    ...mapState([
    //        'allerror'
    //    ])
    },
    methods: {
        save(){
            axios
                .post('/user/update-password', {
                    currentPassword: this.currentPassword,
                    newPassword: this.newPassword,
                    newPassword_confirmation: this.newPassword_confirmation
                })
                .then(response => {
                    this.isEditing = false;
                })
                .catch(error => 
                    this.allerror = error.response.data.errors,
                )
        }
        
    }
}
</script>

<style>

</style>