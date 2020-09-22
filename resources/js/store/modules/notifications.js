import router from "../../router"

export const notifications = {
    namespaced: true,

    state: {

        requestedEmails: [],
        eventId: '',
        dialog: false,
        dialogForSchedule: false,
        allerror: [],
        
    },
    mutations: {
        setRequestedEmails(state, payload){
            state.requestedEmails = payload;
        },
        showDialog(state){
            state.dialog = true;
        },
        showDialogForSchedule(state){
            state.dialogForSchedule = true;
        },
        closeDialog(state){
            state.dialog = false;
        },
        closeDialogForSchedule(state){
            state.dialogForSchedule = false;
        },
        setEventId(state, payload){
            state.eventId = payload;
        },
        setallErrors(state, payload){
            state.allerror = payload;
        },
    },
    actions: {
        async saveEmailToParticipants({state, commit}, payload){

            console.log('payloda');
            console.log(payload.user_id);
           
            // let participants = [];

            await axios
                .post("/inst/email-participants/", {
                    event_id: payload.event_id,
                    subject: payload.subject,
                    body_text: payload.body_text,
                    respond_email: payload.respond_email,
                })
                .then(response => {
                    console.log(response);
                    commit("closeDialog");
                    router.push({name: 'participant-communications', params: {id: payload.user_id}});
                })
                .catch(error => 
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                )
        },
        async fetchEmailsToParticipantsList({commit}){

            // console.log('fetchEmails');
            // console.log(payload.id);

            let requestedEmails = [];

            await axios
                .get('/inst/emailstoparticipants-list')
                .then(response => {
                    requestedEmails = response.data.emails;
                    console.log(requestedEmails);
                    commit('setRequestedEmails', requestedEmails);
                })

        },
        async scheduleEmailToParticipants({commit}, payload){
            console.log(payload);

            await axios
                .post('/inst/schedule-emailstoparticipants', {
                    event_id: payload.event_id,
                    scheduled_date: payload.scheduled_date,
                    scheduled_time: payload.scheduled_time,
                    timezone: payload.timezone
                })
                .then(response => {
                    commit('closeDialog');
                })
                .catch(error => 
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                )
        },
        showDialogForSchedule({state, commit}, payload){

            console.log('dialog');
            console.log(payload.event_id);

            commit('setEventId', payload.event_id);
            commit('showDialogForSchedule');

        }

    }

}