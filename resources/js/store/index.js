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
        start_utc: [],
        end_utc: [],
        description: [],
        files: [],
        eventRegions: [],
        eventLevels: [],
        eventSubjects: [],
        participants:[],
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
        setSingleEvent(state,payload){
            state.event = payload
            state.title = payload.title
            state.date = payload.date
            state.timezone = payload.timezone
            state.start_time = payload.start_time
            state.end_time = payload.end_time
            state.start_utc = payload.start_utc
            state.end_utc = payload.end_utc
            state.description = payload.description
            state.files = payload.image
        },
        setEventRegions(state, payload){
            state.eventRegions = payload
        },
        setEventLevels(state, payload){
            state.eventLevels = payload
        },
        setEventSubjects(state, payload){
            state.eventSubjects = payload
        },
        setParticipants(state, payload){
            state.participants = payload
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
        async fetchSingleEvent({commit}, payload){
            // console.log(payload.id);

            let event = [];

            await axios
                .get("/inst/fetch-single-event/" + payload.id)
                .then(res => {
                event = res.data.event;
                commit("setSingleEvent", event)
                })
        },
        async fetchEventRegions({commit}, payload){
            // console.log(payload.id);

            let eventRegions = [];

            await axios
                .get("/inst/fetch-event-regions/" + payload.id)
                .then(res => {
                eventRegions = res.data.eventRegions;
                commit("setEventRegions", eventRegions)
            })
        },
        async fetchEventLevels({commit}, payload){
            // console.log(payload.id);

            let eventLevels = [];

            await 
                axios
                .get("/inst/fetch-event-levels/" + payload.id)
                .then(res => {
                    eventLevels = res.data.eventLevels;
                    commit("setEventLevels", eventLevels)
                })
        },
        async fetchEventSubjects({commit}, payload){
            // console.log(payload.id);

            let eventSubjects = [];

            await axios
                .get("/inst/fetch-event-subjects/" + payload.id)
                .then(res => {
                    eventSubjects = res.data.eventSubjects;
                    commit("setEventSubjects", eventSubjects)
                })
        },
        async fetchEventParticipants({commit}, payload){
            console.log(payload.id);

            let participants = [];

            await axios 
                .get("/inst/event-participants/" + payload.id)
                .then(response => {
                    participants = response.data.participants;
                    console.log(participants);
                    commit("setParticipants", participants)
                })
        },
    },
    modules: {
        
    }

})