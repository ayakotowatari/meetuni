export const student = {
    namespaced: true,

    state: {
        allEvents: [],
    },
     
    mutations: {
        setAllEvents(state, payload){
            state.allEvents = payload
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
    }
}