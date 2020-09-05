import Vue from "vue";
import VueRouter from "vue-router";
 
Vue.use(VueRouter);
 
<<<<<<< HEAD
import Home from "./components/HomeComponent";
import UserDetails from "./components/student/userdetails/UserDetailsComponent";
=======
// import Home from "./components/HomeComponent";
import UserDetails from "./components/student/userdetails/UserDetailsComponent";
import StudentMain from "./components/student/StudentMainComponent";
>>>>>>> master

//テスト

//テスト終わる
 
const routes = [
    {
        path: "/student/details",
        name: "details",
        component: UserDetails
    },
<<<<<<< HEAD
=======
    {
        path: "/student/main",
        name: "student-main",
        component: StudentMain
    },
>>>>>>> master
];
 
export default new VueRouter({
    //URLに#をつけなくする
    mode: "history",
    routes
});
