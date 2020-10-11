import Vue from "vue";
import VueRouter from "vue-router";
 
Vue.use(VueRouter);
 
// import Home from "./components/HomeComponent";
import UserDetails from "./components/student/userdetails/UserDetailsComponent";
import Main from "./components/student/main/MainComponent";
import AllEvents from "./components/student/main/AllEventsComponent";
import RecommendedEvents from "./components/student/main/RecommendedEventsComponent";
import EventDetails from "./components/student/events/EventDetailsComponent";
import BookedEvents from "./components/student/account/BookedEventsComponent";
import EventPage from "./components/student/events/EventPageComponent";
import Following from "./components/student/account/FollowingComponent";
import Liked from "./components/student/account/LikedComponent";
import StudentProfile from "./components/student/profile/StudentProfileComponent";
import EventList from "./components/student/events/EventListComponent";
import SearchResult from "./components/student/main/SearchResultComponent";
import LikeLogin from "./components/student/auth/LikeLoginComponent"
import Login from "./components/student/auth/LoginComponent"
import BookLogin from "./components/student/auth/BookLoginComponent"
import StudentRegister from "./components/student/auth/RegisterComponent"
import FollowLogin from "./components/student/auth/FollowLoginComponent"

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
                    component: AllEvents, 
                },
                {
                    //RecommendedEvents will be rendered inside Main's <router-view>
                    //when /main/recommended-events is matched.
                    path: "recommended-events",
                    name: "recommended-events",
                    component: RecommendedEvents
                },
            ]
    },
    {
        path: "/student/event-details/:id",
        name: "event-details",
        component: EventDetails
    },
    {
        path: "/student/booked-events/:id",
        name: "booked-events",
        component: BookedEvents
    },
    {
        path: "/student/event-page/:id",
        name: "event-page",
        component: EventPage
    },
    {
        path: "/student/following/:id",
        name: "following",
        component: Following
    },
    {
        path: "/student/liked/:id",
        name: "liked",
        component: Liked
    },
    {
        path: "/student/profile",
        name: "student-profile",
        component: StudentProfile
    },
    {
        path: "/student/event-list/:id",
        name: "event-list",
        component: EventList
    },
    {
        path: "/student/login-like/:id",
        name: "student-loginlike",
        component: LikeLogin
    },
    {
        path: "/student/login-main",
        name: "student-login",
        component: Login
    },
    {
        path: "/student/login-book/:id",
        name: "student-loginbook",
        component: BookLogin
    },
    {
        path: "/student/register-main",
        name: "student-register",
        component: StudentRegister
    },
    {
        path: "/student/login-follow/:id",
        name: "student-loginfollow",
        component: FollowLogin
    },
    {
        path: "/student/search-result",
        name: "search-result",
        component: SearchResult
    },

    //テスト
    // {
    //     path: "/student/test",
    //     name: "testone-component",
    //     component: TestOne
    // },
    // {
    //     path: "/student/testthree",
    //     name: "testthree-component",
    //     component: TestThree
    // },
    //テスト終わり

];
 
export default new VueRouter({
    //URLに#をつけなくする
    mode: "history",
    routes
});
