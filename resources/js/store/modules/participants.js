export const participants = {
    namespaced: true,

    state: {
        participants:[],
    },
    mutations: {
        setParticipants(state, payload){
            state.participants = payload
        }

    },
    actions: {
        async fetchEventParticipants({commit}, payload){
            console.log(payload);
            let participants = [];

            await axios
                .get("/inst/event-participants/" + payload.id)
                .then(response => {
                    participants = response.data.participants;
                    console.log(participants);
                    commit("setParticipants", participants)
                });
        },

    }

}