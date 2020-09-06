export const student = {
    namespaced: true,

    state: {
        allEvents: [],
        recommendedEvents: []
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
        setRecommendedEvents(state, payload){
            state.recommendedEvents = payload
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
        async recommendEventsWithSubjects({commit}, payload){
            let events = [];
            console.log(payload.id);

            await axios
                .get("/student/event-subjects/" + payload.id)
                .then(res => {
                    events = res.data.events;
                    console.log(events);
                    commit("setRecommendedEvents", events)
                });
        }
    }
}