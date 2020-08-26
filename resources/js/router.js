import Vue from "vue";
import VueRouter from "vue-router";
 
Vue.use(VueRouter);
 
import Home from "./components/HomeComponent";
// import ExampleComponent from "./components/ExampleComponent";
import Events from "./components/inst/EventsComponent";
import CreateEvents from "./components/inst/CreateEventsComponent";
import Drafts from "./components/inst/DraftsComponent";
import Dashboard from "./components/inst/DashboardComponent";
import ManageParticipants from "./components/inst/ManageParticipantsComponent";
import ParticipantStatistics from "./components/inst/ParticipantStatisticsComponent";
import InstProfile from "./components/inst/InstProfileComponent";

//テスト
// import Test from "./components/inst/TestComponent"
// import TestTwo from "./components/inst/TestTwoComponent"
import TestThree from "./components/inst/TestThreeComponent"
import TestFour from "./components/inst/TestFourComponent"
//テスト終わる
 
const routes = [
    {
        path: "/inst",
        name: "home",
        component: Home
    },
    {
        path: "/inst/events",
        name: "events",
        component: Events
    },
    {
        path: "/inst/create-events",
        name: "create-events",
        component: CreateEvents
    },
    {
        path: "/inst/event/dashboard/:id",
        name: "dashboard",
        component: Dashboard
    },
    {
        path: "/inst/event/manage-participants/:id",
        name: "manage-participants",
        component: ManageParticipants
    },
    {
        path: "/inst/event/participant-statistics/:id",
        name: "participant-statistics",
        component: ParticipantStatistics
    },
    {
        path: "/inst/drafts",
        name: "drafts",
        component: Drafts
    },
    {
        path: "/inst/profile",
        name: "inst-profile",
        component: InstProfile
    },
    // //テスト
    // {
    //     path: "/inst/test",
    //     name: "test",
    //     component: Test
    // },
    // {
    //     path: "/inst/testtwo",
    //     name: "testtwo",
    //     component: TestTwo
    // },
    {
        path: "/inst/testthree",
        name: "testthree",
        component: TestThree
    },
    {
        path: "/inst/testfour",
        name: "testfour",
        component: TestFour
    },

];
 
export default new VueRouter({
    //URLに#をつけなくする
    mode: "history",
    routes
});
