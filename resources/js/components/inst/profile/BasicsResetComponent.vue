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
                    color="primary"
                    outlined
                    @click="toEdit == !toEdit"
                >Edit</v-btn>
            </v-col>
        </v-row>
        <v-form ref="form">
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
                <v-col cols="12" sm="12" md="3">
                    <v-text-field
                        v-model="jobTitle"
                        label="Job Title" 
                        outlined
                        required
                        :rules="jobtitleRules"
                        :error="allerror.job_title"
                        :error-messages="allerror.job_title"
                    ></v-text-field>
                </v-col>
                <v-col cols="12" sm="12" md="3">
                    <v-text-field
                        v-model="department"
                        label="Department" 
                        outlined
                        required
                        :rules="departmentRules"
                        :error="allerror.department"
                        :error-messages="allerror.department"
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col col="12" sm="12" md="6" class="py-0">
                    <v-btn 
                        depressed 
                        color="primary" 
                        @click="submit"
                    >Save
                    </v-btn>
                    <v-btn 
                        color="primary" 
                        outlined
                        class="ml-4" 
                        @click="cancel"
                    >Cancel
                    </v-btn>
                </v-col>
            </v-row>
        </v-form>
    </div>
</template>

<script>
export default {
    props: {
        user: Object
    },
    data: function(){
        return{
            isEdited: false,
            firstnameRules: [
                v => !!v || 'First Name is required',
            ],
            lastnameRules: [
                v => !!v || 'Last Name is required',
            ],
            jobtitleRules: [
                v => !!v || 'Job Title is required',
            ],
            departmentRules: [
                v => !!v || 'Job Title is required',
            ],
            allerror: []
        }
    },
    computed: {
        firstName: {
            get(){
                return this.user.first_name
            },
            set (value) {
                this.$store.commit('updateFirstName', value)
            }
        },
        lastName: {
            get(){
                return this.user.last_name
            },
            set (value) {
                this.$store.commit('updateLastName', value)
            }
        },
        jobTitle: {
            get(){
                return this.user.job_title
            },
            set (value) {
                this.$store.commit('updateJobTitle', value)
            }
        },
        department: {
            get(){
                return this.user.department
            },
            set (value) {
                this.$store.commit('updateDepartment', value)
            }
        },
    },
    methods: {
        reset(){
            this.$refs.form.reset();
        },
        submit(){
            
        },
    }

}
</script>

<style>

</style>