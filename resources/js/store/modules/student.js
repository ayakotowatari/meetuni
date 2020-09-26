// import moment from 'moment-timezone'

export const student = {
    namespaced: true,

    state: {
        user: {
            first_name: '',
            last_name: '',
            email: '',
            password: '',
            timezone: '',
        },
        initials: '',
        allEvents: [],
        event: [],
        eventsList: [],
        inst: {},
        regions: [],
        levels: [],
        subjects: [],
        recommendedSubjectEvents: [],
        recommendedDestinationEvents: [],
        recommendedRegionEvents: [],
        isLiked: true,
        eventId: '',
        isFollowed: false,
        isEditingForProfileBasics: false,
        loading: false,
        allerror: [],
    },

    getters: {
        //stateの値を加工して、componentで使いたい時。
        //componentsではcomputedで展開
        // formattedStartTime: (state) => (timezone) =>{
        //     return moment.utc(state.event.start_utc).local().tz(timezone).format("h:mm a")
        // }
    },
    
    mutations: {
        setStudentUser(state, payload){
            state.user = payload
        },
        setInitials(state, payload){
            state.initials = payload
        },
        setAllEvents(state, payload){
            // payload.forEach(event => state.allEvents.push(event))
            state.allEvents = payload
            // console.log('setAllEvents');
            // console.log(state);
        },
        setRecommendedSubjectEvents(state, payload){
            // console.log(payload);
            // payload.forEach(event => state.recommendedSubjectEvents.push(event))
            // console.log('setRecommnedeSubjectEvents');
            // console.log(state);
            state.recommendedSubjectEvents = payload
        },
        setRecommendedDestinationEvents(state, payload){
            payload.forEach(event => state.recommendedDestinationEvents.push(event))
        },
        setRecommendedRegionEvents(state, payload){
            payload.forEach(event => state.recommendedRegionEvents.push(event))
        },
        setEvent(state, payload){
            state.event = payload.event
            state.regions = payload.regions
            state.levels = payload.levels
            state.subjects = payload.subjects
        },
        setInst(state, payload){
            state.inst = payload;
        },
        // setRecommendedSubjectEvents(state, payload){
        //     state.recommendedSubjectEvents = payload
        // },
        // setRecommendedDestinationEvents(state, payload){
        //     state.recommendedDestinationEvents = payload
        // },
        // setRecommendedRegionEvents(state, payload){
        //     state.recommendedRegionEvents = payload
        // },
        likedByUser(state,payload){  
            console.log('setLikedByUser');
            console.log(payload);
            let event = state.allEvents.find(event=>event.id == payload);
            console.log(event);
            event.liked_by_user = true;
            console.log(state);
        },
        unlikedByUser(state,payload){  
            console.log('unlikedByuser');
            console.log(payload);
            let event = state.allEvents.find(event=>event.id == payload);
            event.liked_by_user = false;
        },
        subjectLikedByUser(state,payload){  
            console.log('LikedByUserSubject');
            // console.log(payload);
            let event = state.recommendedSubjectEvents.find(event=>event.id == payload);
            console.log(event);
            event.liked_by_user = true;
            // console.log(state);
        },
        subjectUnlikedByUser(state,payload){  
            console.log('LikedByUserSubject');
            // console.log(payload);
            let event = state.recommendedSubjectEvents.find(event=>event.id == payload);
            console.log(event);
            event.liked_by_user = false;
            // event.liked_by_user = true;
            // console.log(state);
        },
        destinationLikedByUser(state,payload){  
            console.log('LikedByUserSubject');
            // console.log(payload);
            let event = state.recommendedDestinationEvents.find(event=>event.id == payload);
            console.log(event);
            event.liked_by_user = true;
            // console.log(state);
        },
        destinationUnlikedByUser(state,payload){  
            console.log('LikedByUserSubject');
            // console.log(payload);
            let event = state.recommendedDestinationEvents.find(event=>event.id == payload);
            console.log(event);
            event.liked_by_user = false;
            // event.liked_by_user = true;
            // console.log(state);
        },
        regionLikedByUser(state,payload){  
            console.log('LikedByUserSubject');
            // console.log(payload);
            let event = state.recommendedRegionEvents.find(event=>event.id == payload);
            console.log(event);
            event.liked_by_user = true;
            // console.log(state);
        },
        regionUnlikedByUser(state,payload){  
            console.log('LikedByUserSubject');
            // console.log(payload);
            let event = state.recommendedRegionEvents.find(event=>event.id == payload);
            console.log(event);
            event.liked_by_user = false;
            // event.liked_by_user = true;
            // console.log(state);
        },
        setEventsList(state, payload){
            state.eventsList = payload
        },
        instLikedByUser(state,payload){
            let event = state.eventsList.find(event=>event.id == payload);
            event.liked_by_user = true;
        },
        instUnlikedByUser(state,payload){
            let event = state.eventsList.find(event=>event.id == payload);
            event.liked_by_user = false;
        },
        setIsEditingForProfileBasics(state){
            state.isEditingForProfileBasics = true
        },
        hasFinishedEditingForProfileBasics(state){
            state.isEditingForProfileBasics = false
        },
        updateFirstName(state, payload){
            state.user.first_name = payload
        },
        updateLastName(state, payload){
            state.user.last_name = payload
        },
        startLoading(state){
            state.loading = true;
        },
        stopLoading(state){
            state.loading = false;
        },
        setallErrors(state, payload){
            state.allerror = payload
        }
    },

    actions: {
        async fetchStudentUser({ commit }){
            let payload = [];

            await axios
                .get("/student/fetch-user")
                .then(res => {
                    payload = res.data.user;
                    commit('setStudentUser', payload)
                    console.log(payload);
            });
        },
        async fetchInitials({ commit }) {
            let payload = '';

            await axios
                .get("/student/fetch-initials")
                .then(res => {
                    payload = res.data.initials;
                    commit('setInitials', payload)
            });
        },
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
        async fetchSingleEvent({commit}, payload){
            let event = [];
            let regions = [];
            let levels = [];
            let subjects = [];

            await axios
                .get("/student/fetch-details/" + payload.id)
                .then(res => {
                    event = res.data.event;
                    regions = res.data.regions;
                    levels = res.data.levels;
                    subjects = res.data.subjects
                    console.log(event)
                    console.log(regions)
                    console.log(levels)
                    console.log(subjects)
                    commit("setEvent", {event, regions, levels, subjects});
                });
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
        async recommendSubjectEvents({commit}, payload){
            let events = {};
            // console.log(payload.id);

            await axios
                .get("/student/event-subjects/" + payload.id)
                .then(res => {
                    events = res.data.events;
                    console.log(events);
                    commit("setRecommendedSubjectEvents", events)
                });
        },
        async recommendDestinationEvents({commit}, payload){
            let events = [];
            // console.log(payload.id);

            await axios
                .get("/student/event-destinations/" + payload.id)
                .then(res => {
                    events = res.data.events;
                    // console.log(events);
                    commit("setRecommendedDestinationEvents", events)
                });
        },
        async recommendRegionEvents({commit}, payload){
            
            let events = [];
            console.log('recommedRegionEvents');
            console.log(payload.id);

            await axios
                .get("/student/event-regions/" + payload.id)
                .then(res => {
                    events = res.data.events;
                    // console.log(events);
                    commit("setRecommendedRegionEvents", events)
                });
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
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async unlikeEvent({commit}, payload){

            // console.log(payload.user_id);
            // console.log(payload.event_id);

            let eventId = '';
            let allerror = [];

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
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async SubjectLikeEvent({commit}, payload){

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
                    commit('subjectLikedByUser', eventId)                 
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async SubjectUnlikeEvent({commit}, payload){

            console.log(payload.user_id);
            console.log(payload.event_id);

            let allerror = [];
            let eventId = '';

            await axios
                .post('/student/unlike-event', {
                    user_id: payload.user_id,
                    event_id: payload.event_id
                })
                .then(response => {
                    // console.log(response);
                    eventId = response.data.event_id
                    // commit('setEventId', eventId);
                    // commit('isLiked', liked);
                    console.log(eventId);
                    commit('subjectUnlikedByUser', eventId)                 
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async DestinationLikeEvent({commit}, payload){

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
                    commit('destinationLikedByUser', eventId)                 
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async DestinationUnlikeEvent({commit}, payload){

            console.log(payload.user_id);
            console.log(payload.event_id);

            let allerror = [];
            let eventId = '';

            await axios
                .post('/student/unlike-event', {
                    user_id: payload.user_id,
                    event_id: payload.event_id
                })
                .then(response => {
                    // console.log(response);
                    eventId = response.data.event_id
                    // commit('setEventId', eventId);
                    // commit('isLiked', liked);
                    console.log(eventId);
                    commit('destinationUnlikedByUser', eventId)                 
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async RegionLikeEvent({commit}, payload){

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
                    commit('regionLikedByUser', eventId)                 
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async RegionUnlikeEvent({commit}, payload){

            console.log(payload.user_id);
            console.log(payload.event_id);

            let allerror = [];
            let eventId = '';

            await axios
                .post('/student/unlike-event', {
                    user_id: payload.user_id,
                    event_id: payload.event_id
                })
                .then(response => {
                    // console.log(response);
                    eventId = response.data.event_id
                    // commit('setEventId', eventId);
                    // commit('isLiked', liked);
                    console.log(eventId);
                    commit('regionUnlikedByUser', eventId)                 
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async fetchEventList({commit}, payload){

            let events = [];
            let inst = {};

            await axios
                .get('/student/fetch-eventlist/' + payload.id)
                .then(response => {
                    events = response.data.events;
                    inst = response.data.inst;
                    commit('setEventsList', events)
                    commit('setInst', inst);
                })
        },
        async likeInstEvent({commit}, payload){

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
                    commit('instLikedByUser', eventId)                 
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async unlikeInstEvent({commit}, payload){

            // console.log(payload.user_id);
            // console.log(payload.event_id);

            let eventId = '';
            let allerror = [];

            await axios
                .post('/student/unlike-event', {
                    user_id: payload.user_id,
                    event_id: payload.event_id
                })
                .then(response => {
                    console.log(response);
                    eventId = response.data.event_id;
                    console.log(eventId);
                    commit('instUnlikedByUser', eventId);
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        //プロフィール編集
        async updateProfileBasics({commit}, payload){

            let user = {};
            commit('startLoading');

            await axios
                .post('/student/update-basicinfo', {
                    first_name: payload.first_name,
                    last_name: payload.last_name,
                })
                .then(response => {
                    user = response.data.user;
                    commit('stopLoading');
                    commit('setUser', user);
                    commit('hasFinishedEditing');
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        //テスト

    }
}