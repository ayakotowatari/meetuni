import Vue from "vue";
import VueRouter from "vue-router";
 
Vue.use(VueRouter);
 
import Home from "./components/HomeComponent";
// import ExampleComponent from "./components/ExampleComponent";
import Projects from "./components/inst/ProjectsComponent";
import CreateEvents from "./components/inst/CreateEventsComponent";
import Drafts from "./components/inst/DraftsComponent";
import Dashboard from "./components/inst/DashboardComponent";
import InstProfile from "./components/inst/InstProfileComponent";
import Test from "./components/TestComponent"
 
const routes = [
    {
        path: "/inst",
        name: "home",
        component: Home
    },
    {
        path: "/inst/projects",
        name: "projects",
        component: Projects
    },
    {
        path: "/inst/projects/dashboard/:id",
        name: "dashboard",
        component: Dashboard
    },
    {
        path: "/inst/create-events",
        name: "create-events",
        component: CreateEvents
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
    {
        path: "/inst/test",
        name: "test",
        component: Test
    },
];
 
export default new VueRouter({
    //URLに#をつけなくする
    mode: "history",
    routes
});
