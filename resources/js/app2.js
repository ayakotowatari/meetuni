/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import router from "./router2";
import AppTwoComponent from "./components/AppTwoComponent";
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
Vue.component('navbar-component', require('./components/student/parts/NavbarComponent.vue').default);
Vue.component('search-component', require('./components/student/parts/SearchComponent.vue').default);
Vue.component('bookingdialog2-component', require('./components/student/events/BookingDialogComponent.vue').default);
Vue.component('bookingdialog-component', require('./components/student/account/BookingDialogComponent.vue').default);
Vue.component('cancellationdialog-component', require('./components/student/account/CancellationDialogComponent.vue').default);
Vue.component('questionsdialog-component', require('./components/student/events/QuestionsDialogComponent.vue').default);
Vue.component('followdialog-component', require('./components/student/events/FollowDialogComponent.vue').default);
Vue.component('refollowdialog-component', require('./components/student/account/RefollowDialogComponent.vue').default);
Vue.component('eventcard-component', require('./components/student/main/EventCardComponent.vue').default);
Vue.component('subjecteventcard-component', require('./components/student/main/SubjectEventCardComponent.vue').default);
Vue.component('destinationeventcard-component', require('./components/student/main/DestinationEventCardComponent.vue').default);
Vue.component('regioneventcard-component', require('./components/student/main/RegionEventCardComponent.vue').default);
//Chart
//プロフィール編集
Vue.component('editbasicprofile-component', require('./components/student/profile/EditBasicProfileComponent.vue').default);
Vue.component('editpassword-component', require('./components/student/profile/EditPasswordComponent.vue').default);
Vue.component('editpreference-component', require('./components/student/profile/EditPreferenceComponent.vue').default);
Vue.component('edittimezone-component', require('./components/student/profile/EditTimezoneComponent.vue').default);


//テスト
Vue.component('testone-component', require('./components/student/TestOneComponent.vue').default);
Vue.component('testtwo-component', require('./components/student/TestTwoComponent.vue').default);

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
        'apptwo-component': AppTwoComponent
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
