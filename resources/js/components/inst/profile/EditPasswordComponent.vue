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
                    v-if="!isEditing"
                    color="primary"
                    outlined
                    @click="isEditing = !isEditing"
                >Edit</v-btn>
            </v-col>
        </v-row>
        <v-form v-if="isEditing" ref="form">
            <v-row justify="center">
                <v-col cols="12" sm="12" md="6">
                        <v-text-field 
                            v-model="currentPassword"
                            label="Current Password" 
                            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                            :type="showPassword ? 'text' : 'password'"
                            outlined
                            required
                            :error="allerror.currentPassword"
                            :error-messages="allerror.currentPassword"
                            name="current-password"
                            @click:append="showPassword = !showPassword"
                        ></v-text-field>
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col cols="12" sm="12" md="6">
                        <v-text-field 
                            label="New Password" 
                            v-model="newPassword" 
                            :append-icon="showPassword2 ? 'mdi-eye' : 'mdi-eye-off'"
                            :type="showPassword2 ? 'text' : 'password'"
                            outlined
                            :rules="passwordRules" 
                            required
                            :error="allerror.newPassword"
                            :error-messages="allerror.newPassword"
                            name="newPassword"
                            @click:append="showPassword2 = !showPassword2"
                        ></v-text-field>
                </v-col>
            </v-row>
                <v-row justify="center">
                <v-col cols="12" sm="12" md="6">
                        <v-text-field 
                            label="Confirm New Password" 
                            v-model="newPassword_confirmation"
                            :append-icon="showPassword3 ? 'mdi-eye' : 'mdi-eye-off'"
                            :type="showPassword3 ? 'text' : 'password'"
                            outlined
                            :rules="confirmpasswordRules" 
                            required
                            name="newPassword_confirmation"
                            @click:append="showPassword3 = !showPassword3"
                        ></v-text-field>
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col cols="12" sm="12" md="6" class="py-0">
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
            newPassword_confirmation: '',
            confirmpasswordRules: [],
            allerror: [],
            showPassword: false,
            showPassword2: false,
            showPassword3: false

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