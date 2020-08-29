import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store ({

    state: {
        //状態を管理する
        //component側でstateからデータを取るのはcomputed
        events: [],
        regions: [],
        levels: [],
        subjects: []
        
    },
    getters: {
        //stateの値を加工して、componentで使いたい時。
        //componentsではcomputedで展開

    },
    mutations: {
        //actionsが終わった後の同期処理をする
        //change and edite data in state
        //componentsではmethodsで展開
        setEvents(state,payload){
            state.events = payload
        },
        setRegions(state,payload){
            state.regions = payload
        },
        setLevels(state,payload){
            state.levels = payload
        },
        setSubjects(state,payload){
            state.subjects = payload
        }
        

    },
    actions: {
        //非同期処理をする
        //componentsではmethodsで展開

        async fetchEvents({commit}) {
        let payload = [];
        await axios
            .get("/inst/fetch-events")
            .then(response => {
                payload = response.data.events;
                commit("setEvents", payload)
            });
        },
        async fetchRegions({commit}) {
        let payload = [];
        await axios
            .get("/inst/fetch-regions")
            .then(res => {
              payload = res.data.regions;
              commit("setRegions", payload)
            })
        },
        async fetchLevels({commit}) {
            let payload = [];
            await axios
                .get("/inst/fetch-levels")
                .then(res => {
                  payload = res.data.levels;
                  commit("setLevels", payload)
                })
        },
        async fetchSubjects({commit}) {
            let payload = [];
            await axios
                .get("/inst/fetch-subjects")
                .then(res => {
                  payload = res.data.subjects;
                  commit("setSubjects", payload)
                })
        },
    },
    modules: {

    }

})