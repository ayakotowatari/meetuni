export const chart = {
    namespaced: true,

    state: {
        eventBookingsNumber: '',
        eventLikesNumber: '',
        eventQuestionsNumber: '',
        allerror: []
        
    },
    mutations: {
        setEventBookingsNumber(state, payload){
            state.eventBookingsNumber = payload
        },
        setEventLikesNumber(state, payload){
            state.eventLikesNumber = payload
        },
        setEventQuestionsNumber(state, payload){
            state.eventQuestionsNumber = payload
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
        },
        async fetchEventLikesNumber({state, commit}, payload){

            let likes = '';
            let allerror = [];

            await axios 
                .get('/inst/likes-number/' + payload.id)
                .then(response => {
                    likes = response.data.likes
                    commit('setEventLikesNumber', likes)
                })
                .catch(error => {
                    allerror = error.response.data.errors
                    commit('setallErrors', allerror)
                })
        },
        async fetchEventQuestionsNumber({state, commit}, payload){

            let questions = '';
            let allerror = [];

            await axios 
                .get('/inst/questions-number/' + payload.id)
                .then(response => {
                    questions = response.data.questions
                    commit('setEventQuestionsNumber', questions)
                })
                .catch(error => {
                    allerror = error.response.data.errors
                    commit('setallErrors', allerror)
                })
        }


    }

}