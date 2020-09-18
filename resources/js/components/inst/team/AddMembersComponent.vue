<template>
    <div>
        <v-container>
            <h1 class="grey--text">Add New Members</h1>
            <v-row justify="center" class="mt-10 mb-4">
                <v-col col="12" sm="12" md="8">
                    <h4 class="grey--text text--darken-3">An invitation email to register will be sent to your team members once you provided their details below and clicked Submit.</h4>
                </v-col>
            </v-row>
            <v-form ref="form">
                    <v-row justify="center">
                        <v-col cols="12" sm="12" md="4">
                            <v-text-field 
                                label="First Name" 
                                v-model="first_name" 
                                required
                                :rules="firstNameRules" 
                                :error="allerror.first_name"
                                :error-messages="allerror.first_name"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="4">
                            <v-text-field 
                                label="Last Name" 
                                v-model="last_name" 
                                required
                                :rules="lastNameRules" 
                                :error="allerror.last_name"
                                :error-messages="allerror.last_name"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row justify="center">
                        <v-col cols="12" sm="12" md="4">
                            <v-text-field 
                                v-model='email'
                                label="Email" 
                                required
                                :rules="emailRules" 
                                :error="allerror.email"
                                :error-messages="allerror.email"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="4">
                            <v-text-field  
                                label="Confirm Email" 
                                :rules="confirmEmailRules"
                                required
                            ></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row justify="center">
                        <v-col cols="12" sm="12" md="4">
                            <v-text-field 
                                label="Job Title" 
                                v-model="job_title" 
                                required
                                :rules="jobTitleRules" 
                                :error="allerror.job_title"
                                :error-messages="allerror.job_title"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="4">
                            <v-text-field 
                                label="Department" 
                                v-model="department" 
                                required
                                :rules="departmentRules" 
                                :error="allerror.department"
                                :error-messages="allerror.department"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row justify="center">
                        <v-col col="12" sm="12" md="8">
                            <v-btn 
                            depressed 
                            block 
                            color="primary" 
                            class="mx-0" 
                            @click="invite"
                            :loading="loading"
                            >Send Invitation
                            </v-btn>
                        </v-col>
                    </v-row>
            </v-form>
        </v-container>
    </div>
</template>

<script>
import { mapState, mapMutations } from 'vuex'

export default {
    props: {
        user: Object,
        inst: Object
    },
    data: function(){
        return {
            loading: false,
            first_name: '',
            firstNameRules: [
                v => !!v || 'First name is required',
            ],
            last_name: '',
            lastNameRules: [
                v => !!v || 'Last name is required',
            ],
            email: '',
            emailRules: [
                (v) => !!v || 'E-mail is required',
                (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
            ],
            confirmEmailRules: [
                (v) => !!v || 'Confirmation E-mail is required',
                (v) => v == this.email || 'E-mail must match'
            ],
            job_title: '',
            jobTitleRules: [
                (v) => !!v || 'Job Title is required',
            ],
            department: '',
            departmentRules: [
                (v) => !!v || 'Department is required',
            ],
            allerror: []
        }
    },
    computed: {
       
    },
    methods: {
        invite(){

            if(this.$refs.form.validate()){
                this.loading = true;

                axios
                    .post('/inst/invite-members', {  
                        user_id: this.user.id,
                        inst_id: this.inst.id,
                        first_name: this.first_name,
                        last_name: this.last_name,
                        email: this.email,
                        job_title: this.job_title,
                        department: this.department
                    })
                    .then(response => {
                        this.loading = false
                    })
                    .catch(error => 
                        this.allerror = error.response.data.errors,
                    )
            }
        }
    }

}
</script>

<style>

</style>