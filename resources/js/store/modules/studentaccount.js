export const studentaccount = {
    namespaced: true,

    state: {
        dialog: false,
        isBooked: false,
        events: [],
    },
    getters: {
        //stateの値を加工して、componentで使いたい時。
        //componentsではcomputedで展開
       
    },
    mutations: {
        showDialog(state){
            state.dialog = true
        },
        closeDialog(state){
            state.dialog = false
        },
        isBooked(state){
            state.isBooked = true
        },
        isCancelled(state){
            state.isBooked = false
        },
        setBookedEvents(state, payload){
            state.events = payload
        },
    },
    actions: {
        async registerEvent({state, commit}, payload){
            console.log(payload)

            await axios
                .post("/student/register-event", {
                    id: payload.event_id,
                    first_name: payload.first_name,
                    last_name: payload.last_name,
                    email: payload.email
                })
                .then(response => {
                    commit('closeDialog');
                    commit('isBooked');
                })
                .catch(error => 
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                )
        },
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