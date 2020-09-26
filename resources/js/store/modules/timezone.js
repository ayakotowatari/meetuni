import Axios from "axios"

export const timezone = {
    namespaced: true,

    state: {
        isEditing: false,
        timezones: [],
        allerror: [],

       
        
    },
    mutations: {
        setTimezoneList(state, payload){
            state.timezones = payload
        },
        setIsEditing(state){
            state.isEditing = true
        },
        hasFinishedEditing(state){
            state.isEditing = false
        },
        setallErrors(state, payload){
            state.allerror = payload
        }
    },
    actions: {
        async getTimezoneList({state, commit}){

            let timezone = [];
            let allerror = [];

            await axios
                .get('/user/timezone-list')
                .then(response => {
                    timezone = response.data.timezone;
                    commit('setTimezoneList', timezone);
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        }
       

    }

}