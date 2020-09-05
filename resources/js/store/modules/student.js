export const student = {
    namespaced: true,

    state: {
        allEvents: [],
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
        }
    },

    actions: {
        async fetchAllEvents({commit}){
            let payload = [];
            let loading = true;

            await axios
                .get("/student/all-events")
                .then(res => {
                    payload = res.data.events;
                    commit("setAllEvents", payload);
                    console.log(payload)
                });
        },
    }
}