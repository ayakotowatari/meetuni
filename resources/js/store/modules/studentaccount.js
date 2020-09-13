import router from "../../router"

export const studentaccount = {
    namespaced: true,

    state: {
        allEvents: [],
        inst: {},
        likedEvents: [],
        isLiked: true,
        dialog: false,
        followDialog: false,
        isBooked: false,
        bookings: [],
        bookingId: '',
        eventId: '',
        categories: [],
        allerror: [],
    },
    getters: {
        //stateの値を加工して、componentで使いたい時。
        //componentsではcomputedで展開
       
    },
    mutations: {
        // setAllEvents(state, payload){
        //     state.allEvents = payload
        // },
        setAllEvents(state, payload){
            payload.forEach(event => state.allEvents.push(event))
            // console.log('setAllEvents');
            // console.log(state);
        },
        setLikedEvents(state, payload){
            state.likedEvents = payload
            // console.log(payload);
            // payload.forEach(event => state.likedEvents.push(event))
            // console.log('setLikedEvents');
            // console.log(state);
        },
        setInst(state, payload){
            state.inst = payload;
        },
        // setLikedEvents(state,payload){
        //     state.likedEvents = payload
        // },
        showDialog(state){
            state.dialog = true
        },
        closeDialog(state){
            state.dialog = false
        },
        closeFollowDialog(state){
            state.followDialog = false
        },
        showFollowDialog(state){
            state.followDialog = true
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
        setEventId(state, payload){
            state.eventId = payload
        },
        setallErrors(state,payload){
            state.allerror = payload
        },
        setCategories(state, payload){
            state.categories = payload
        },
        setEventId(state, payload){
            state.eventId = payload
        },
        isFollowed(state){
            state.inst.followed_by_user = true
        },
        isUnfollowed(state){
            state.inst.followed_by_user = false
        },
        unlikedByUser(state, payload){
            let event = state.likedEvents.find(event=>event.id == payload);
            // console.log(event);
            event.liked_by_user = false;
        },
        likedByUser(state,payload){  
            console.log('LikedByUser');
            console.log(payload);
            let event = state.likedEvents.find(event=>event.id == payload);
            console.log(event);
            event.liked_by_user = true;
            console.log(state);
        },
        
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
        async fetchLikedEvents({commit}, payload){
            console.log(payload.id);
            // console.log(payload.id);
            // console.log(payload);

            let events = [];

            await axios
                .get("/student/fetch-likedevents/" + payload.id)
                .then(res => {
                    events = res.data.events;
                    // console.log(events);
                    commit("setLikedEvents", events);
                })
        },
        async registerEvent({state, commit}, payload){
            // console.log(payload)

            let allerror = [];

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
        showDialogWithBookingId({state, commit}, payload){
            console.log(payload.id);

            commit('showDialog');
            commit('setBookingId', payload.id);
            
        },
        showDialogWithEventId({state, commit}, payload){
            console.log(payload.id);

            commit('showDialog');
            commit('setEventId', payload.id);
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

            let allerror= [];

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
        async fetchInst({commit}, payload){

            console.log(payload.id);

            let inst = [];

            await axios
                .get('/student/fetch-inst/' + payload.id)
                .then(response => {
                    inst = response.data.inst;
                    commit("setInst", inst)
                })
        },
        async followInst({commit}, payload){
            console.log(payload.inst_id);
            console.log(payload.user_id);

            await axios
                .post('/student/follow-inst', {
                    inst_id: payload.inst_id,
                    user_id: payload.user_id
                })
                .then(response => {
                    console.log(response);
                    commit('isFollowed');
                    commit('showFollowDialog');
                })
        },
        async unfollowInst({commit}, payload){
            console.log(payload.inst_id);
            console.log(payload.user_id);

            await axios
                .post('/student/unfollow-inst', {
                    inst_id: payload.inst_id,
                    user_id: payload.user_id
                })
                .then(response => {
                    console.log(response);
                    commit('isUnfollowed');
                })
        },
        async unlikeEvent({commit}, payload){

            // console.log(payload.user_id);
            // console.log(payload.event_id);

            let eventId = '';
            let allerror =[];

            await axios
                .post('/student/unlike-event', {
                    user_id: payload.user_id,
                    event_id: payload.event_id
                })
                .then(response => {
                    console.log(response);
                    eventId = response.data.event_id;
                    console.log(eventId);
                    commit('unlikedByUser', eventId);
                })
                .catch(error => 
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                )
        },
        async likeEvent({commit}, payload){

            // console.log(payload.user_id);
            // console.log(payload.event_id);

            let allerror = [];
            let eventId = '';

            await axios
                .post('/student/like-event', {
                    user_id: payload.user_id,
                    event_id: payload.event_id
                })
                .then(response => {
                    // console.log(response);
                    eventId = response.data.event_id
                    // commit('setEventId', eventId);
                    // commit('isLiked', liked);
                    commit('likedByUser', eventId)                 
                })
                .catch(error => 
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                )
        },
        
    }
}