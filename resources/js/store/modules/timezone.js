export const timezone = {
    namespaced: true,

    state: {
        user: {},
        isEditing: false,
        timezones: [],
        loading: false,
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
        },
        startLoading(state){
            state.loading = true
        },
        stopLoading(state){
            state.loading = false
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
        },
        async updateTimezone({commit}, payload){

            let user = {};

            commit('startLoading');

            await axios
                .post('/user/update-timezone', {
                    timezone: payload.timezone
                })
                .then(response => {
                    user = response.data.user;
                    commit('setUser', user);
                    commit('stopLoading');
                    commit('hasFinishedEditing');
                }) 
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        }
       

    }

}