/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import router from "./router";
import AppComponent from "./components/AppComponent";
import Vuetify from 'vuetify';
import store from './store/';
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader
Vue.use(Vuetify);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('navbar-component', require('./components/inst/parts/NavbarComponent.vue').default);
Vue.component('dashboardmenu-component', require('./components/inst/dashboard/DashboardMenuComponent.vue').default);
Vue.component('dashboardsummary-component', require('./components/inst/dashboard/DashboardSummaryComponent.vue').default);
Vue.component('dashboardchart-component', require('./components/inst/dashboard/DashboardChartComponent.vue').default);
Vue.component('eventheader-component', require('./components/inst/parts/EventHeaderComponent.vue').default);
Vue.component('eventbasics-component', require('./components/inst/events/create/EventBasicsComponent.vue').default);
Vue.component('eventselect-component', require('./components/inst/events/create/EventSelectComponent.vue').default);
Vue.component('eventfile-component', require('./components/inst/events/create/EventFileComponent.vue').default);
Vue.component('editeventbasics-component', require('./components/inst/events/edit/EditEventBasicsComponent.vue').default);
Vue.component('editeventselect-component', require('./components/inst/events/edit/EditEventSelectComponent.vue').default);
Vue.component('editeventfile-component', require('./components/inst/events/edit/EditEventFileComponent.vue').default);
Vue.component('addmemberdialog-component', require('./components/inst/team/AddMemberDialogComponent.vue').default);
Vue.component('memberslist-component', require('./components/inst/team/MembersListComponent.vue').default);
Vue.component('deletememberdialog-component', require('./components/inst/team/DeleteMemberDialogComponent.vue').default);
Vue.component('emailtoparticipantsdialog-component', require('./components/inst/communications/EmailToParticipantsDialogComponent.vue').default);
Vue.component('emailtoparticipantsdialog2-component', require('./components/inst/participants/EmailToParticipantsDialogComponent.vue').default);
Vue.component('emailtoparticipantslist-component', require('./components/inst/communications/EmailToParticipantsListComponent.vue').default);
Vue.component('scheduleemaildialog-component', require('./components/inst/communications/ScheduleEmailDialogComponent.vue').default);

//Chart
Vue.component('eventbookingchart-component', require('./components/inst/dashboard/EventBookingChartComponent.vue').default);
Vue.component('linechart-component', require('./components/chart/LineChartComponent.vue').default);
Vue.component('participantslist-component', require('./components/inst/participants/ParticipantsListComponent.vue').default);
Vue.component('piechart-component', require('./components/chart/PieChartComponent.vue').default);
Vue.component('participantcountrypie-component', require('./components/inst/participants/ParticipantCountryPieComponent.vue').default);
Vue.component('participantcountrylist-component', require('./components/inst/participants/ParticipantCountryListComponent.vue').default);
Vue.component('participantlevelpie-component', require('./components/inst/participants/ParticipantLevelPieComponent.vue').default);
Vue.component('participantlevellist-component', require('./components/inst/participants/ParticipantLevelListComponent.vue').default);
Vue.component('participantdestinationpie-component', require('./components/inst/participants/ParticipantDestinationPieComponent.vue').default);
Vue.component('participantdestinationlist-component', require('./components/inst/participants/ParticipantDestinationListComponent.vue').default);
Vue.component('participantsubjectbar-component', require('./components/inst/participants/ParticipantSubjectBarComponent.vue').default);
Vue.component('participantsubjectlist-component', require('./components/inst/participants/ParticipantSubjectListComponent.vue').default);
Vue.component('barchart-component', require('./components/chart/BarChartComponent.vue').default);

//テスト




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        'app-component': AppComponent
    },
    vuetify: new Vuetify({
        icons: {
          iconfont: 'mdi', // default - only for display purposes
        },
        theme: {
          themes:{
            light:{
              primary: '#323EDD',
              success: '#FFDF34',
              info: '#25DD76',
              error: '#DE04DD',
              background: '#f5f5f5'
            }
          }
        },
      }),
});
