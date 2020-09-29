import Vue from "vue";
import VueRouter from "vue-router";
 
Vue.use(VueRouter);
 
import Home from "./components/HomeComponent";
// import ExampleComponent from "./components/ExampleComponent";
import Events from "./components/inst/events/EventsComponent";
import CreateEvents from "./components/inst/events/create/CreateEventsComponent";
import EditEvents from "./components/inst/events/edit/EditEventsComponent";
import Dashboard from "./components/inst/dashboard/DashboardComponent";
import ManageParticipants from "./components/inst/participants/ManageParticipantsComponent";
import ParticipantStatistics from "./components/inst/participants/ParticipantStatisticsComponent";
import Team from "./components/inst/team/TeamComponent";
import AddMembers from "./components/inst/team/AddMembersComponent";
import UserProfile from "./components/inst/profile/UserProfileComponent";
import ParticipantCommunications from "./components/inst/communications/ParticipantCommunicationsComponent";
import EventQuestions from "./components/inst/participants/EventQuestionsComponent";


//テスト
// import Test from "./components/inst/TestComponent"
// import TestTwo from "./components/inst/TestTwoComponent"
import TestThree from "./components/inst/TestThreeComponent"
import TestFour from "./components/inst/TestFourComponent"
import TestFive from "./components/inst/TestFiveComponent"
import TestSix from "./components/inst/TestSixComponent"
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
        path: "/inst/event/edit/:id",
        name: "edit-events",
        component: EditEvents
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
        path: "/inst/event/questions/:id",
        name: "event-questions",
        component: EventQuestions
    },
    {
        path: "/inst/team",
        name: "inst-team",
        component: Team
    },
    {
        path: "/inst/team/add-members",
        name: "add-members",
        component: AddMembers
    },
    {
        path: "/inst/profile",
        name: "user-profile",
        component: UserProfile
    },
    {
        path: "/inst/participant-communications",
        name: "participant-communications",
        component: ParticipantCommunications
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
    {
        path: "/inst/testfive",
        name: "testfive",
        component: TestFive
    },
    {
        path: "/inst/testsix",
        name: "testsix",
        component: TestSix
    },

];
 
export default new VueRouter({
    //URLに#をつけなくする
    mode: "history",
    routes
});
