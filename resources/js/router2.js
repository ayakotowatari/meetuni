import Vue from "vue";
import VueRouter from "vue-router";
 
Vue.use(VueRouter);
 
// import Home from "./components/HomeComponent";
import UserDetails from "./components/student/userdetails/UserDetailsComponent";
import Main from "./components/student/main/MainComponent";
import AllEvents from "./components/student/main/AllEventsComponent";
import RecommendedEvents from "./components/student/main/RecommendedEventsComponent";

//テスト

//テスト終わる
 
const routes = [
    {
        path: "/student/details",
        name: "details",
        component: UserDetails
    },
    {
        path: "/student/main",
        name: "main",
        component: Main, 
            children: [
                {
                    path: '',
                    component: AllEvents

                },
                {
                    //AllEvents will be rendered inside Main's <router-view>
                    //when /main/all-events is matched.
                    path: "all-events",
                    name: "all-events",
                    component: AllEvents
                },
                {
                    //ForYouEvents will be rendered inside Main's <router-view>
                    //when /main/foryou-events is matched.
                    path: "recommended-events",
                    name: "recommended-events",
                    component: RecommendedEvents
                },
            ]
    },
];
 
export default new VueRouter({
    //URLに#をつけなくする
    mode: "history",
    routes
});
