<template>
    <v-container>
        <h1 class="subheading grey--text">My Profile</h1>
        <editbasicprofile-component
            v-bind:user="user"
            class="mb-8"
        ></editbasicprofile-component>
        <v-row justify="center">
            <v-col col="12" sm="12" md="8">
                <v-divider></v-divider>
            </v-col>
        </v-row>
        <editemail-component
            v-bind:user="user"
            class="mb-8"
        ></editemail-component>
        <v-row justify="center">
            <v-col col="12" sm="12" md="8">
                <v-divider></v-divider>
            </v-col>
        </v-row>
        <editpassword-component
            v-bind:user="user"
            class="mt-6 mb-8"
        ></editpassword-component>
        <v-row justify="center">
            <v-col col="12" sm="12" md="8">
                <v-divider></v-divider>
            </v-col>
        </v-row>
        <edittimezone-component
            v-bind:user="user"
            class="mt-6 mb-8"
        ></edittimezone-component>
        <v-row justify="center">
            <v-col col="12" sm="12" md="8">
                <v-divider></v-divider>
            </v-col>
        </v-row>
        <edityear-component
            v-bind:user="user"
            class="mt-6 mb-8"
        ></edityear-component>
        <v-row justify="center">
            <v-col col="12" sm="12" md="8">
                <v-divider></v-divider>
            </v-col>
        </v-row>
        <editdestinations-component
            v-bind:user="user"
            class="mt-6 mb-8"
        ></editdestinations-component>
        <v-row justify="center">
            <v-col col="12" sm="12" md="8">
                <v-divider></v-divider>
            </v-col>
        </v-row>
        <editlevels-component
            v-bind:user="user"
            class="mt-6 mb-8"
        ></editlevels-component>
         <v-row justify="center">
            <v-col col="12" sm="12" md="8">
                <v-divider></v-divider>
            </v-col>
        </v-row>
        <editsubjects-component
            v-bind:user="user"
            class="mt-6 mb-8"
        ></editsubjects-component>
    </v-container>
</template>

<script>
import EditBasicProfile from './EditBasicProfileComponent'
import EditEmail from './EditEmailComponent'
import EditPassword from './EditPasswordComponent'
import EditTimezone from './EditTimezoneComponent'
import EditYear from './EditYearComponent'
import EditDestinations from './EditDestinationsComponent'
import EditLevels from './EditLevelsComponent'
import EditSubjects from './EditSubjectsComponent'

export default {
    components: {
        EditBasicProfile,
        EditEmail,
        EditPassword,
        EditTimezone,
        EditYear,
        EditDestinations,
        EditLevels,
        EditSubjects
    },
    props: {
        user: Object
    }

}
</script>

<style>

</style>