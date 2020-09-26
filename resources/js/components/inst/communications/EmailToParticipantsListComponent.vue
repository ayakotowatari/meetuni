<template>
    <div>
        <scheduleemaildialog-component
            v-bind:dialog="dialog"
            v-bind:event_id="eventId"
            v-bind:user="user"
        ></scheduleemaildialog-component>
        <v-data-table
            :headers="headers"
            :items="emails"
            class="elevation-1"
        > 
            <template v-slot:[`item.status`]="{ item }">
                <v-chip :color="getColor(item.status)" dark>{{ item.status }}</v-chip>
            </template>
            <template v-slot:[`item.schedule`]="{ item }">
                <v-icon
                v-show="item.status !== 'Sent'"
                small
                class="mr-4"
                @click="showDialog(item.id)"
                >
                mdi-clock-outline
                </v-icon>
            </template>
            <template v-slot:[`item.edit`]="{ item }">
                <v-icon
                v-show="item.status !== 'Draft'"
                small
                class="mr-4"
                @click="edit(item.id)"
                >
                mdi-pencil-outline
                </v-icon>
            </template>
        </v-data-table>
    </div>
</template>

<script>
import ScheduleEmailDialog from './ScheduleEmailDialogComponent'

import { mapState, mapActions } from 'vuex'

export default {
    components: {
        ScheduleEmailDialog
    },
    props: {
        user: Object,
        emails: Array,
        dialog: Boolean
    },
    data: function(){
        return {
            headers: [
                {
                    text: 'Event Title',
                    align: 'start',
                    sortable: false,
                    value: 'title',
                },
                { text: 'Status', value: 'status' },
                { text: 'Schedule', value: 'schedule' },
                { text: 'Delivery Date', value: 'scheduled_date' },
                { text: 'Time', value: 'scheduled_time' },
                { text: 'Timezone', value: 'timezone' },
                { text: 'Edit', value: 'edit' }
            ],
        }
    },
    mounted(){
       
    },
    computed: {
        ...mapState('notifications', [
            'eventId'
        ])
    },
    methods: {
        getColor(status){
            if (status == 'Draft') return 'error'
            else if (status == 'Sent') return 'info'
            else return 'primary'
        },
        ...mapActions('notifications', [
            'showDialogForSchedule'
        ]),
        showDialog(id){
            console.log('check');
            console.log(id);
            this.showDialogForSchedule({
                event_id: id
            })
        }
    }

}
</script>

<style>

</style>