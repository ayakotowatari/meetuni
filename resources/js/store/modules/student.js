export const student = {
    namespaced: true,

    state: {
        allEvents: [],
        event: [],
        recommendedSubjectEvents: [],
        recommendedDestinationEvents: [],
        recommendedRegionEvents: [],
    },

    getters: {
        //stateの値を加工して、componentで使いたい時。
        //componentsではcomputedで展開
        // formattedStartTime: (state) => (value, timezone) => {
        //     return state.allEvents.start_utc.moment.utc(value).local().tz(timezone).format("h:mm a")
        // }
    },
    
    mutations: {
        setAllEvents(state, payload){
            state.allEvents = payload
        },
        setEvent(state, payload){
            state.event = payload
        },
        setRecommendedSubjectEvents(state, payload){
            state.recommendedSubjectEvents = payload
        },
        setRecommendedDestinationEvents(state, payload){
            state.recommendedDestinationEvents = payload
        },
        setRecommendedRegionEvents(state, payload){
            state.recommendedRegionEvents = payload
        }
    },

    actions: {
        async fetchAllEvents({commit}){
            let payload = [];

            await axios
                .get("/student/all-events")
                .then(res => {
                    payload = res.data.events;
                    commit("setAllEvents", payload);
                    console.log(payload)
                });
        },
        async fetchSingleEvent({commit}, payload){
            let event = [];

            await axios
                .get("/student/event-details/" + payload.id)
                .then(res => {
                    event = res.data.event;
                    commit("setEvent", event);
                    console.log(event)
                });
        },
        async recommendSubjectEvents({commit}, payload){
            let events = [];
            console.log(payload.id);

            await axios
                .get("/student/event-subjects/" + payload.id)
                .then(res => {
                    events = res.data.events;
                    console.log(events);
                    commit("setRecommendedSubjectEvents", events)
                });
        },
        async recommendDestinationEvents({commit}, payload){
            let events = [];
            console.log(payload.id);

            await axios
                .get("/student/event-destinations/" + payload.id)
                .then(res => {
                    events = res.data.events;
                    console.log(events);
                    commit("setRecommendedDestinationEvents", events)
                });
        },
        async recommendRegionEvents({commit}, payload){
            let events = [];
            console.log(payload.id);

            await axios
                .get("/student/event-regions/" + payload.id)
                .then(res => {
                    events = res.data.events;
                    console.log(events);
                    commit("setRecommendedRegionEvents", events)
                });
        }
    }
}