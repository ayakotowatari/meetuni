// import moment from 'moment-timezone'

export const student = {
    namespaced: true,

    state: {
        allEvents: [],
        event: {},
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
        setAllEvents(state, payload){
            payload.forEach(event => state.allEvents.push(event))
            console.log('setAllEvents');
            console.log(state);
        },
        setRecommendedSubjectEvents(state, payload){
            payload.forEach(event => state.recommendedSubjectEvents.push(event))
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
        setRecommendedSubjectEvents(state, payload){
            state.recommendedSubjectEvents = payload
        },
        setRecommendedDestinationEvents(state, payload){
            state.recommendedDestinationEvents = payload
        },
        setRecommendedRegionEvents(state, payload){
            state.recommendedRegionEvents = payload
        },
        LikedByUser(state,payload){  
            console.log('setLikedByUser');
            console.log(payload);
            const event = state.allEvents.find(event=>event.id == payload);
            console.log(event);
            event.liked_by_user = true;
            console.log(state);
        },
        UnlikedByUser(state,payload){  
            console.log('unlikedByuser');
            console.log(payload);
            const event = state.allEvents.find(event=>event.id == payload);
            event.liked_by_user = false;
        },
        setallErrors(state, payload){
            state.allerror = payload
        }
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
            let events = [];
            console.log(payload.id);

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
            console.log(payload.id);

            await axios
                .get("/student/event-destinations/" + payload.id)
                .then(res => {
                    events = res.data.events;
                    console.log(events);
                    commit("setRecommendedDestinationEvents", events)
                });
        },
        async recommendRegionEvents({commit}, payload){
            let events = [];
            console.log(payload.id);

            await axios
                .get("/student/event-regions/" + payload.id)
                .then(res => {
                    events = res.data.events;
                    console.log(events);
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
                    commit('LikedByUser', eventId)                 
                })
                .catch(error => 
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                )
        },
        async unlikeEvent({commit}, payload){

            // console.log(payload.user_id);
            // console.log(payload.event_id);

            let eventId = '';

            await axios
                .post('/student/unlike-event', {
                    user_id: payload.user_id,
                    event_id: payload.event_id
                })
                .then(response => {
                    console.log(response);
                    eventId = response.data.event_id;
                    console.log(eventId);
                    commit('UnlikedByUser', eventId);
                })
                .catch(error => 
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                )
        },
        //テスト

    }
}