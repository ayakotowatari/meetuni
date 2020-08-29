import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store ({

    state: {
        //状態を管理する
        //component側でstateからデータを取るのはcomputed
        user: [],
        inst: [],
        initials: '',
        events: [],
        regions: [],
        levels: [],
        subjects: [],
        event: [],
        title: [],
        date: [],
        timezone: [],
        start_time: [],
        end_time: [],
        description: [],
        files: []
    },
    getters: {
        //stateの値を加工して、componentで使いたい時。
        //componentsではcomputedで展開

    },
    mutations: {
        //actionsが終わった後の同期処理をする
        //change and edite data in state
        //componentsではmethodsで展開
        setUser(state, payload){
            state.user = payload
        },
        setInst(state, payload){
            state.inst = payload
        },
        setInitials(state, payload){
            state.initials = payload
        },
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
        },

        //テスト
        setSingleEvent(state,payload){
            state.event = payload
            state.title = payload.title
            state.date = payload.date
            state.timezone = payload.timezone
            state.start_time = payload.start_time
            state.end_time = payload.end_time
            state.description = payload.description
            state.files = payload.image
        }
    },
    actions: {
        //非同期処理をする
        //componentsではmethodsで展開

        async fetchUser({ commit }){
            let payload = [];

            await axios
                .get("/inst/fetch-user")
                .then(res => {
                    payload = res.data.user;
                    commit('setUser', payload)
            });
        },
        async fetchInst({ commit }) {
            let payload = [];

            await axios
                .get("/inst/fetch-inst")
                .then(res => {
                    payload = res.data.inst;
                    commit('setInst', payload)
            });
        },
        async fetchInitials({ commit }) {
            let payload = '';

            await axios
                .get("/inst/fetch-initials")
                .then(res => {
                    payload = res.data.initials;
                    commit('setInitials', payload)
            });
        },
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
        //テスト
        async fetchSingleEvent({commit}, payload){
            console.log(payload.id);

            let event = [];

            await axios
                .get("/inst/fetch-single-event/" + payload.id)
                .then(res => {
                event = res.data.event;
                commit("setSingleEvent", event)
                })
        },
    },
    modules: {

    }

})