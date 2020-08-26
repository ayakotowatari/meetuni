<template>
    <v-container>
        <v-row>
            <v-col col="12" sm="12" md="6">
                <h3 class="grey--text text--darken-4">{{ event.title }}</h3>
                <span>{{ formattedDate(event.date, user.timezone) }} </span>
                <span class="ml-3">
                    {{ formattedStartTime(event.start_utc, user.timezone) }} - 
                    {{ formattedEndTime(event.end_utc, user.timezone) }}
                </span>
                <div>
                    <span>Targets:</span>
                    <span v-for="region in regions" :key="region.region" class="ml-3">{{ region.region }}</span>
                </div>
                <div>
                    <span>Levels:</span>
                    <span v-for="level in levels" :key="level.level" class="ml-3">{{ level.level }}</span>
                </div>
                <div>
                    <span>Subjects:</span>
                    <span v-for="subject in subjects" :key="subject.subject" class="ml-3">{{ subject.subject }}</span>
                </div>
            </v-col>  
            <v-spacer></v-spacer>   
            <v-col col="12" sm="2" md="2" offset-md-4>
                <dashboardmenu-component />
            </v-col>    
        </v-row>
    </v-container>
</template>

<script>
import moment from 'moment-timezone'
import DashboardMenu from './DashboardMenuComponent'

export default {
    components: { DashboardMenu },
    props: {
    user: Object,
    },

    data: function(){
        return{
            id: this.$route.params.id,
            event: {},
            regions: {},
            levels: {},
            subjects: {}
        }
        console.log(id);
    },
    created(){
        this.fetchSingleEvent();
        this.fetchEventRegions();
        this.fetchEventLevels();
        this.fetchEventSubjects();
    },
    methods: {
        fetchSingleEvent: function(id) {
            console.log(id);
            axios.get("/inst/fetch-single-event/" + this.id).then(res => {
                this.event = res.data.event;
                console.log(event);
            })
        },
        fetchEventRegions: function(id) {
            console.log(id);
            axios.get("/inst/fetch-event-regions/" + this.id).then(res => {
                this.regions = res.data.regions;
            })
        },
        fetchEventLevels: function(id) {
            console.log(id);
            axios.get("/inst/fetch-event-levels/" + this.id).then(res => {
                this.levels = res.data.levels;
            })
        },
        fetchEventSubjects: function(id) {
            console.log(id);
            axios.get("/inst/fetch-event-subjects/" + this.id).then(res => {
                this.subjects = res.data.subjects;
            })
        },
        formattedDate(value, timezone){
            return moment.utc(value).local().tz(timezone).format("ddd, MMM Do YYYY")
        },
        formattedStartTime(value, timezone){
            return moment.utc(value).local().tz(timezone).format("h:mm a")
        },
        formattedEndTime(value, timezone){
            return moment.utc(value).local().tz(timezone).format("h:mm a ([GMT] Z)")
        }
    }
}


</script>

<style>

</style>