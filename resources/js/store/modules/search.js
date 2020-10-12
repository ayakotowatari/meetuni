import router from "../../router2"

export const search = {
    namespaced: true,

    state: {
        results: [],
        message: [],
        
    },
    mutations: {
        setResults(state, payload){
            state.results = payload
        },
        setMessage(state, payload){
            state,message = payload
        }
       
    },
    actions: {
        async searchEvents({commit}, payload){

            let results = [];
            
            await axios 
                .post('/student/search-event',{
                    term: payload.term
                })
                .then(response => {
                    results = response.data.results
                    commit('setResults', results)
                    router.push({name: 'search-result'})
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setMessage', allerror)
                })

        }

    }

}