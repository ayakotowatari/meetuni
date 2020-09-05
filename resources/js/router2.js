import Vue from "vue";
import VueRouter from "vue-router";
 
Vue.use(VueRouter);
 
// import Home from "./components/HomeComponent";
import UserDetails from "./components/student/userdetails/UserDetailsComponent";
import StudentMain from "./components/student/StudentMainComponent";

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
        name: "student-main",
        component: StudentMain
    },
];
 
export default new VueRouter({
    //URLに#をつけなくする
    mode: "history",
    routes
});
