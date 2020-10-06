import router from "../../router"

export const notifications = {
    namespaced: true,

    state: {

        events: [],
        requestedEmails: [],
        eventId: '',
        emailId: '',
        dialog: false,
        dialogForSchedule: false,
        dialogForReschedule: false,
        allerror: [],
        
    },
    mutations: {
        setEventsForEmails(state,payload){
            state.events = payload
        },
        setRequestedEmails(state, payload){
            state.requestedEmails = payload;
        },
        showDialog(state){
            state.dialog = true;
        },
        showDialogForSchedule(state){
            state.dialogForSchedule = true;
        },
        showDialogForReschedule(state){
            state.dialogForReschedule = true;
        },
        closeDialog(state){
            state.dialog = false;
        },
        closeDialogForSchedule(state){
            state.dialogForSchedule = false;
        },
        closeDialogForReschedule(state){
            state.dialogForReschedule = false;
        },
        setEventId(state, payload){
            state.eventId = payload;
        },
        setEmailId(state, payload){
            state.emailId = payload
        },
        setallErrors(state, payload){
            state.allerror = payload;
        },
    },
    actions: {
        async fetchEventsForEmails({commit}) {

            let payload = [];

            await axios
                .get("/inst/fetchevents-emails")
                .then(response => {
                    payload = response.data.events;
                    commit("setEventsForEmails", payload)
                });
        },
        async saveEmailToParticipants({state, commit}, payload){

            console.log('payloda');
            console.log(payload.user_id);
           
            // let participants = [];

            await axios
                .post("/inst/email-participants", {
                    event_id: payload.event_id,
                    subject: payload.subject,
                    body_text: payload.body_text,
                    respond_email: payload.respond_email,
                })
                .then(response => {
                    console.log(response);
                    commit("closeDialog");
                    router.go();
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async saveEmailToParticipantsFromDashboard({state, commit}, payload){

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
                    router.push({name: 'participant-communications', params: {id: payload.user_id}});
                    commit("closeDialog");
                   
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
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
                    email_id: payload.email_id,
                    scheduled_date: payload.scheduled_date,
                    scheduled_time: payload.scheduled_time,
                    timezone: payload.timezone
                })
                .then(response => {
                    commit('closeDialogForSchedule');
                    router.go();
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async rescheduleEmailToParticipants({commit}, payload){
            // console.log(payload);

            await axios
                .post('/inst/reschedule-emailstoparticipants', {
                    email_id: payload.email_id,
                    scheduled_date: payload.scheduled_date,
                    scheduled_time: payload.scheduled_time,
                    timezone: payload.timezone
                })
                .then(response => {
                    commit('closeDialogForReschedule');
                    router.go();
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        showDialogForSchedule({state, commit}, payload){

            // console.log('dialog');
            // console.log(payload.email_id);

            commit('setEmailId', payload.email_id);
            commit('showDialogForSchedule');

        },
        showDialogForReschedule({state, commit}, payload){

            // console.log('dialog');
            // console.log(payload.email_id);

            commit('setEmailId', payload.email_id);
            commit('showDialogForReschedule');

        }

    }

}