import Vue from "vue";
import VueRouter from "vue-router";
 
Vue.use(VueRouter);
 
import Home from "./components/HomeComponent";

//テスト

//テスト終わる
 
const routes = [
    {
        path: "/student/main",
        name: "home",
        component: Home
    },
];
 
export default new VueRouter({
    //URLに#をつけなくする
    mode: "history",
    routes
});
