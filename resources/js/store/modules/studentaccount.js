import router from "../../router"

export const studentaccount = {
    namespaced: true,

    state: {
        allEvents: [],
        dialog: false,
        isBooked: false,
        bookings: [],
        bookingId: '',
        categories: [],
        allerror: [],
        isLiked: true,
        eventId: '',
    },
    getters: {
        //stateの値を加工して、componentで使いたい時。
        //componentsではcomputedで展開
       
    },
    mutations: {
        setAllEvents(state, payload){
            state.allEvents = payload
        },
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
        },
        setallErrors(state,payload){
            state.allerror = payload
        },
        setCategories(state, payload){
            state.categories = payload
        },
        isLiked(state, payload){
            state.isLiked = payload
        },
        isUnliked(state){
            state.isLiked = false
        },
        setEventId(state, payload){
            state.eventId = payload
        },
        // setLikedByUser(state,payload){  
        //     const event = state.allEvents.find(event=>event.id === payload);
        //     event.liked_by_user = true;
        //     // state.allEvents = state.allEvents.map (event => {
        //     //     if(event.id === payload){
        //     //         event.liked_by_user = true
        //     //     }
        //     //     return event
        //     // })
        // }
    },
    actions: {
        async fetchAllEvents({commit}){
            let payload = [];

            await axios
                .get("/student/fetch-events")
                .then(res => {
                    payload = res.data.events;
                    commit("setAllEvents", payload);
                    console.log(payload)
                });
        },
        async registerEvent({state, commit}, payload){
            // console.log(payload)

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

            // console.log(payload.id);

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
            // console.log(payload.id);

            commit('showDialog');
            commit('setBookingId', payload.id);
            
        },
        async cancelEvent({commit}, payload){
            // console.log(payload.id);

            await axios
                .post('/student/cancel-event',{
                    id: payload.id
                })
                .then(response => {
                    console.log(response);
                    commit('closeDialog');
                    router.go();
                })
        },
        async saveQuestions({commit}, payload){
            // console.log(payload);

            await axios
                .post('/student/event-queries', {
                    id: payload.id,
                    event_id: payload.event_id,
                    category_id: payload.category_id,
                    contents: payload.contents
                })
                .then(response => {
                    console.log(response)
                    commit('closeDialog')
                })
                .catch(error => 
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                )
        },
        async fetchCategories({state, commit}){

            let categories = [];

            await axios
                .get('/student/fetch-categories')
                .then(response => {
                    categories = response.data.categories;
                    console.log(categories);
                    commit('setCategories', categories);
                })
        },
        async likeEvent({commit}, payload){

            console.log(payload.user_id);
            console.log(payload.event_id);

            let allerror = [];
            let eventId = '';
            let liked = false;

            await axios
                .post('/student/like-event', {
                    user_id: payload.user_id,
                    event_id: payload.event_id
                })
                .then(response => {
                    console.log(response);
                    eventId = response.data.event_id
                    // commit('setEventId', eventId);
                    liked = true;
                    // commit('isLiked', liked);
                    commit('setLikedByUser', eventId)                 
                })
                .catch(error => 
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                )
        },
        async unlikeEvent({commit}, payload){

            // console.log(payload.user_id);
            // console.log(payload.event_id);

            await axios
                .post('/student/unlike-event', {
                    user_id: payload.user_id,
                    event_id: payload.event_id
                })
                .then(response => {
                    console.log(response);
                    commit('isUnliked');
                })
                .catch(error => 
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                )
        }
    }
}