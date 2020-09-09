export const studentaccount = {
    namespaced: true,

    state: {
        events: [],
    },
    getters: {
        //stateの値を加工して、componentで使いたい時。
        //componentsではcomputedで展開
       
    },
    mutations: {
        setBookedEvents(state, payload){
            state.events = payload
        },
    },
    actions: {
        async fetchBookedEvents({commit}, payload){

            console.log(payload.id);

            let events = [];
            let start_time = [];

            await axios
                .get('/student/fetch-bookedevents/' + payload.id)
                .then(response => {
                    events = response.data.events;
                    start_time = response.data.events.start_time
                    commit('setBookedEvents', events);
                })
        }

    }

}