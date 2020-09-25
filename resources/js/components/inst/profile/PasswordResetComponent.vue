<template>
    <div>
        <v-btn @click="toUpdate = !toUpdate">change</v-btn>
        <v-form v-if="toUpdate">
            <v-row justify="center">
                <v-col col="12" sm="12" md="8">
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
                <v-col col="12" sm="12" md="8">
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
                <v-col col="12" sm="12" md="8">
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
            <v-btn @click="update">update</v-btn>
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
            toUpdate: false,
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
        change(){
            this.toUpdate = true;
        },
        update(){
            axios
                .post('/user/update-password', {
                    currentPassword: this.currentPassword,
                    newPassword: this.newPassword,
                    newPassword_confirmation: this.newPassword_confirmation
                })
                .then(response => {
                    this.toUpdate = false;
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