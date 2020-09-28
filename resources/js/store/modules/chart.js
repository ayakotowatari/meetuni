export const chart = {
    namespaced: true,

    state: {
        eventBookingsNumber: '',
        allerror: []
        
    },
    mutations: {

        setEventBookingsNumber(state, payload){
            state.eventBookingsNumber = payload
        },
        setallErrors(state, payload){
            state.allerror = payload
        }
       
    },
    actions: {
        async fetchEventBookingsNumber({state, commit}, payload){

            let bookings = '';
            let allerror = [];

            await axios 
                .get('/inst/bookings-number/' + payload.id)
                .then(response => {
                    bookings = response.data.bookings
                    commit('setEventBookingsNumber', bookings)
                })
                .catch(error => {
                    allerror = error.response.data.errors
                    commit('setallErrors', allerror)
                })


        }

    }

}