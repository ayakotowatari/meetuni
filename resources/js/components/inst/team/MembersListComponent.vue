<template>
    <div>
        <deletememberdialog-component
            v-bind:dialog="dialog"
            v-bind:memberId="memberId"
        ></deletememberdialog-component>
        <v-row>
            <v-col cols="12" sm="4" offset-sm="8">
            <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Search"
                single-line
                hide-details
            ></v-text-field>
            </v-col>
        </v-row>
        <v-data-table
            :headers="headers"
            :items="members"
            :search="search"
            class="elevation-1 mt-10"
        >
            <template v-slot:[`item.actions`]="{ item }">
                <v-icon
                    small
                    @click="showDialog(item.id)"
                >
                    mdi-trash-can-outline
                </v-icon>
            </template>
        </v-data-table>
    </div>
</template>

<script>
import DeleteMemberDialog from './DeleteMemberDialogComponent'
import { mapState, mapMutations, mapActions } from 'vuex'

export default {
    components: {
        DeleteMemberDialog,
    },
    props: {
        user: Object,
        inst: Object,
    },
    data: () => {
        return {
            search: '',
            selected: [],
            headers: [
                {
                text: 'Last Name',
                align: 'start',
                sortable: false,
                value: 'last_name',
                },
                { text: 'First Name', value: 'first_name' },
                { text: 'E-mail', value: 'email' },
                { text: 'Job Title', value: 'job_title' },
                { text: 'Department', value: 'department' },
                { text: 'Actions', value: 'actions' }
            ],
            allerror: []
        }
    },
    mounted(){
        // this.$store.dispatch('fetchTeamMembers', {
        //     inst_id: this.inst.id
        // });
        this.$store.dispatch('fetchTeamMembers');

        // this.fetchEventParticipants();
    },
    computed: {
        ...mapState([
            'members',
            'dialog',
            'memberId'
        ]),
    },
    methods: {
        // ...mapMutations({
        //     showDialog: 'showDialog'
        // }),
        ...mapActions([
            'deleteTeamMembers',
            'showDeleteMemberDialog'
        ]),
        showDialog(id){

            this.showDeleteMemberDialog({
                member_id: id
            });

        },
    }

}
</script>

<style>

</style>