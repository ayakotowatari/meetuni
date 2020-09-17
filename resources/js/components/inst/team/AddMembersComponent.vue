<template>
    <v-container>
        <h1 class="grey--text">Add New Members</h1>
        <v-form ref="form" class="mt-10">
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
                            label="Password" 
                            v-model="password" 
                            required
                            :rules="passwordRules" 
                            :error="allerror.password"
                            :error-messages="allerror.password"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="12" md="4">
                        <v-text-field  
                            label="Confirm Password" 
                            :rules="confirmPasswordRules"
                            required
                        ></v-text-field>
                    </v-col>
                </v-row>
                <v-row justify="center">
                    <v-col cols="12" sm="12" md="8">
                        <v-select
                            v-model="timezone"
                            :items="['Asia/Tokyo', 'Europe/London']"
                            label="Timezone"
                            :rules="timezoneRules" 
                            hint="What is the new member's timezone?"
                            persistent-hint
                            required
                            :error="allerror.timezone"
                            :error-messages="allerror.timezone"
                        ></v-select>
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
                    <v-col col="12" sm="12" md="1" offset-md="7">
                        <v-btn 
                        :disabled = "isSubmitted"
                        depressed 
                        block 
                        color="primary" 
                        class="mx-0" 
                        @click="showDialog"
                        :loading="loading"
                        >Save
                        </v-btn>
                    </v-col>
            </v-row>
        </v-form>
    </v-container>
</template>

<script>
export default {
    data: function(){
        return {
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
            password: '',
            passwordRules: [
                (v) => !!v || 'Password is required',
                (v) => v.length >= 8 || 'Use 8 characters or more for password',
            ],
            confirmPasswordRules: [
                (v) => !!v || 'Confirmation Password is required',
                (v) => v.length >= 8 || 'Use 8 characters or more for password',
                (v) => v == this.password || 'Password must match'
            ],
            timezone: '',
            timezoneRules: [
            v => !!v || 'Timezone is required',
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

}
</script>

<style>

</style>