import router from "../../router"

export const notifications = {
    namespaced: true,

    state: {

        requestedEmails: [],
        dialog: false,
        allerror: [],
        
    },
    mutations: {
        setRequestedEmails(state, payload){
            state.requestedEmails = payload;
        },
        showDialog(state){
            state.dialog = true;
        },
        closeDialog(state){
            state.dialog = false;
        },
        setallErrors(state, payload){
            state.allerror = payload;
        }
    },
    actions: {
        async saveEmailToParticipants({state, commit}, payload){

            console.log('payloda');
            console.log(payload.event_id);
           
            // let participants = [];

            await axios
                .post("/inst/email-participants/", {
                    event_id: payload.event_id,
                    subject: payload.subject,
                    body_text: payload.body_text,
                    respond_email: payload.respond_email,
                    scheduled_date: payload.scheduled_date,
                    scheduled_time: payload.scheduled_time,
                    timezone: payload.timezone
                })
                .then(response => {
                    console.log(response);
                    commit("closeDialog");
                    router.push({name: 'participant-communications', params: {id: payload.event_id}});
                })
                .catch(error => 
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                )
        },
        async fetchEmailsToParticipantsList({commit}, payload){

            let requestedEmails = [];

            await axios
                .get('/inst/emailstoparticipants-list' + payload.id)
                .then(response => {
                    requestedEmails = response.data.emails;
                    commit('setRequestedEmails', requestedEmails);
                })

        }

    }

}