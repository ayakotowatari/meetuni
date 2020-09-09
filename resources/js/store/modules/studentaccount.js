import router from "../../router"

export const studentaccount = {
    namespaced: true,

    state: {
        dialog: false,
        isBooked: false,
        bookings: [],
        bookingId: '',
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
            state.bookings = payload
        },
        setBookingId(state, payload){
            state.bookingId = payload
        }
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

            let bookings = [];

            await axios
                .get('/student/fetch-bookedevents/' + payload.id)
                .then(response => {
                    bookings = response.data.bookings;
                    commit('setBookedEvents', bookings);
                    commit('isBooked');
                })
        },
        showDialogWithEvent({state, commit}, payload){
            console.log(payload.id);

            commit('showDialog');
            commit('setBookingId', payload.id);
            
        },
        async cancelEvent({commit}, payload){
            console.log(payload.id);

            await axios
                .post('/student/cancel-event',{
                    id: payload.id
                })
                .then(response => {
                    console.log(response);
                    commit('closeDialog');
                    router.go();
                })
        }
    }
}