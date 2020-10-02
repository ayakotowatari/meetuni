// import moment from 'moment-timezone'
import router from "../../router2"

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
        isLoggedIn: false,
        initials: '',
        allEvents: [],
        event: {},
        // bookedEvent: {},
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
        isEditing: false,
        isEditingForProfileBasics: false,
        isEditingForTimezone: false,
        isEditingForYear: false,
        isEditingForDestinations: false,
        isEditingForLevels: false,
        isEditingForSubjects: false,
        loading: false,
        timezones: [],
        year: {
            id: '',
            year: ''
        },
        years: [],
        preference: {
            destinations: [],
            levels: [],
            subjects: []
        },
        destinationList: [],
        levelList: [],
        subjectList: [],
        dialogForLoginToLike: false,
        allerror: {},
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
        isLoggedIn(state){
            state.isLoggedIn = true
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
        setBookedEvent(state, payload){
            state.event = payload.event
            state.regions = payload.regions
            state.levels = payload.levels
            state.subjects = payload.subjects
        },
        setRecommendedSubjectEvents(state, payload){
            // console.log(payload);
            // payload.forEach(event => state.recommendedSubjectEvents.push(event))
            // console.log('setRecommnedeSubjectEvents');
            // console.log(state);
            state.recommendedSubjectEvents = payload
        },
        setRecommendedDestinationEvents(state, payload){
            // payload.forEach(event => state.recommendedDestinationEvents.push(event))
            state.recommendedDestinationEvents = payload
        },
        setRecommendedRegionEvents(state, payload){
            // payload.forEach(event => state.recommendedRegionEvents.push(event))
            state.recommendedRegionEvents = payload
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
        setIsEditing(state){
            state.isEditing = true
        },
        hasFinishedEditing(state){
            state.isEditing = false
        },
        setIsEditingForProfileBasics(state){
            state.isEditingForProfileBasics = true
        },
        hasFinishedEditingForProfileBasics(state){
            state.isEditingForProfileBasics = false
        },
        setIsEditingForTimezone(state){
            state.isEditingForTimezone = true
        },
        hasFinishedEditingForTimezone(state){
            state.isEditingForTimezone = false
        },
        setIsEditingForYear(state){
            state.isEditingForYear = true
        },
        hasFinishedEditingForYear(state){
            state.isEditingForYear = false
        },
        setIsEditingForDestinations(state){
            state.isEditingForDestinations=true
        },
        hasFinishedEditingForDestinations(state){
            state.isEditingForDestinations=false
        },
        setIsEditingForLevels(state){
            state.isEditingForLevels=true
        },
        hasFinishedEditingForLevels(state){
            state.isEditingForLevels=false
        },
        setIsEditingForSubjects(state){
            state.isEditingForSubjects=true
        },
        hasFinishedEditingForSubjects(state){
            state.isEditingForSubjects=false
        },
        updateFirstName(state, payload){
            state.user.first_name = payload
        },
        updateLastName(state, payload){
            state.user.last_name = payload
        },
        updateEmail(state, payload){
            state.user.email = payload
        },
        startLoading(state){
            state.loading = true;
        },
        stopLoading(state){
            state.loading = false;
        },
        setTimezoneList(state, payload){
            state.timezones = payload
        },
        setStudentYear(state, payload){
            state.year = payload
        },
        updateYear(state, payload){
            state.year = payload
        },
        updateYearId(state, payload){
            state.year.id = payload
        },
        setYears(state, payload){
            state.years = payload
        },
        setStudentPreference(state, payload){
            state.preference.destinations = payload.destinations,
            state.preference.levels = payload.levels,
            state.preference.subjects = payload.subjects
        },
        setDestinationList(state, payload){
            state.destinationList = payload
        },
        setLevelList(state, payload){
            state.levelList = payload
        },
        setSubjectList(state, payload){
            state.subjectList = payload
        },
        setallErrors(state, payload){
            state.allerror = payload
        },
        setStudentDestinations(state, payload){
            state.preference.destinations = payload
        },
        setStudentLevels(state, payload){
            state.preference.levels = payload
        },
        setStudentSubjects(state, payload){
            state.preference.subjects = payload
        },
        setEventId(state, payload){
            state.eventId = payload
        },
        showDialogForLoginToLike(state){
            state.dialogForLoginToLike = true;
        },
        closeDialogForLoginToLike(state){
            state.dialogForLoginToLike = false;
        },
    },

    actions: {
        async fetchStudentUser({ commit }){
            let payload = [];

            await axios
                .get("/student/fetch-user")
                .then(res => {
                    payload = res.data.user;
                    commit('setStudentUser', payload)
                    commit('isLoggedIn');
                    console.log(payload);
            });
        },
        async fetchSingleBookedEvent({commit}, payload){
            let event = {};
            let regions = [];
            let levels = [];
            let subjects = [];

            await axios
                .get("/student/fetch-bookedevent/" + payload.id)
                .then(res => {
                    event = res.data.event;
                    regions = res.data.regions;
                    levels = res.data.levels;
                    subjects = res.data.subjects
                    // console.log(event)
                    // console.log(regions)
                    // console.log(levels)
                    // console.log(subjects)
                    commit("setBookedEvent", {event, regions, levels, subjects});
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
        async recommendSubjectEvents({commit}){
            let events = {};
            // console.log(payload.id);

            await axios
                .get("/student/event-subjects")
                .then(res => {
                    events = res.data.events;
                    console.log(events);
                    commit("setRecommendedSubjectEvents", events)
                });
        },
        async recommendDestinationEvents({commit}){
            let events = [];
            // console.log(payload.id);

            await axios
                .get("/student/event-destinations")
                .then(res => {
                    events = res.data.events;
                    // console.log(events);
                    commit("setRecommendedDestinationEvents", events)
                });
        },
        async recommendRegionEvents({commit}){
            
            let events = [];
            console.log('recommedRegionEvents');

            await axios
                .get("/student/event-regions")
                .then(res => {
                    events = res.data.events;
                    // console.log(events);
                    commit("setRecommendedRegionEvents", events)
                });
        },
        async likeEvent({commit}, payload){

            // console.log(payload.user_id);
            console.log('check');
            console.log(payload.event_id);

            let allerror = [];
            let eventId = '';

            await axios
                .post('/student/like-event', {
                    // user_id: payload.user_id,
                    event_id: payload.event_id
                })
                .then(response => {
                    // console.log(response);
                    eventId = response.data.event_id
                    console.log('result');
                    console.log(eventId);
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
                    // user_id: payload.user_id,
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
                    commit('setStudentUser', user);
                    commit('hasFinishedEditing');
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async updateEmail({commit}, payload){

            let allerror = {};
            let user = {};

            await axios
                .post('/student/update-email', {
                    email: payload.email
                })
                .then(response => {
                    user = response.data.user;
                    commit('setStudentUser', user);
                    commit('stopLoading');
                    commit('hasFinishedEditing');
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })

        },
        async getTimezoneList({state, commit}){

            let timezone = [];
            let allerror = [];

            await axios
                .get('/student/timezone-list')
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
                .post('/student/update-timezone', {
                    timezone: payload.timezone
                })
                .then(response => {
                    user = response.data.user;
                    commit('setStudentUser', user);
                    commit('stopLoading');
                    commit('hasFinishedEditingForTimezone');
                }) 
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async fetchStudentYear({state, commit}){

            let year= {};

            await axios
                .get('/student/fetch-year')
                .then(response => {
                    year = response.data.year;
                    // console.log('result');
                    // console.log(year);
                    commit('setStudentYear', year);
                })
        },
        async fetchYearsList({state, commit}){

            let years = [];

            await axios
                .get('/student/fetch-yearlist')
                .then(response => {
                    years = response.data.years;
                    // console.log('result');
                    // console.log(years);
                    commit('setYears', years)
                })
        },
        async updateYear({commit}, payload){

            console.log('check');
            console.log(payload.year_id);

            commit('setIsEditingForYear');

            let year = {};

            await axios
                .post('/student/uddate-year', {
                    year_id: payload.year_id
                })
                .then(response => {
                    year = response.data.year;
                    commit('updateYear', year);
                    commit('hasFinishedEditingForYear');
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async fetchStudentPreference({commit}, payload){

            let destinations = [];
            let levels = [];
            let subjects = [];

            await axios
                .get('/student/fetch-preference')
                .then(response => {
                    destinations = response.data.destinations;
                    levels = response.data.levels;
                    subjects = response.data.subjects;
                    commit('setStudentPreference', {destinations: destinations, levels: levels, subjects: subjects})
                })
        },
        async fetchDestinationList({commit}) {
            let payload = [];

            await axios 
                .get("/student/fetch-destinations")
                .then(res => {
                    payload = res.data.destinations;
                    commit("setDestinationList", payload)
                })
        },
        async fetchLevelList({commit}) {
            let payload = [];
            await axios
                .get("/student/fetch-levels")
                .then(res => {
                  payload = res.data.levels;
                  commit("setLevelList", payload)
                })
        },
        async fetchSubjectList({commit}) {
            let payload = [];
            await axios
                .get("/student/fetch-subjects")
                .then(res => {
                  payload = res.data.subjects;
                  commit("setSubjectList", payload)
                })
        },
        async updateDestinations({commit}, payload){

            commit('startLoading');

            let destinations = [];

            await axios
                .post('/student/update-destinations', {
                    destinations: payload.destinations
                })
                .then(res => {
                    destinations = res.data.destinations;
                    commit('setStudentDestinations', destinations);
                    commit('stopLoading');
                    commit('hasFinishedEditingForDestinations');
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async updateLevels({commit}, payload){

            commit('startLoading');

            let levels = [];

            await axios
                .post('/student/update-levels', {
                    levels: payload.levels
                })
                .then(res => {
                    levels = res.data.levels;
                    commit('setStudentLevels', levels);
                    commit('stopLoading');
                    commit('hasFinishedEditingForLevels');
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },
        async updateSubjects({commit}, payload){

            commit('startLoading');

            let subjects= [];

            await axios
                .post('/student/update-subjects', {
                    subjects: payload.subjects
                })
                .then(res => {
                    subjects = res.data.subjects;
                    commit('setStudentSubjects', subjects);
                    commit('stopLoading');
                    commit('hasFinishedEditingForSubjects');
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },

        //未認証ユーザー用
        showDialogForLoginToLike({state, commit}, payload){

            // console.log('check');
            // console.log(payload.event_id);

            commit('showDialogForLoginToLike');
            commit('setEventId', payload.event_id);

        },
        async loginToLike({commit}, payload){
            // console.log('checkagain');
            // console.log(payload.event_id);

            let event_id = payload.event_id;
            let user = {};

            await axios
                .post(payload.url, {
                    email: payload.email,
                    password: payload.password,
                })
                .then(response => {
                    // console.log(response);
                    commit('closeDialogForLoginToLike');
                    // router.push({path: '/student/main'});
                    window.location = "/student/main";

                    // axios
                    //     .post('/student/like-event', {
                    //         // user_id: payload.user_id,
                    //         event_id: payload.event_id
                    //     })
                    //     .then(response => {
                    //         // console.log(response);
                    //         eventId = response.data.event_id
                    //         commit('setEventId', eventId);
                    //         // commit('isLiked', liked);
                    //         commit('likedByUser', eventId)                 
                    //     })
                    //     .catch(error => {
                    //         allerror = error.response.data.errors,
                    //         commit('setallErrors', allerror)
                    //     })
                })
            },
            async login({state}, payload){
                console.log('checkagain');
                console.log(payload.event_id);
    
                await axios
                    .post(payload.url, {
                        email: payload.email,
                        password: payload.password,
                    })
                    .then(response => {
                        // console.log(response);
                        // router.push({path: '/student/main'});
                        window.location = "/student/main"
                    })
                    .catch(error => {
                        allerror = error.response.data.errors,
                        commit('setallErrors', allerror)
                    })
            },
            async register({state}, payload){

                console.log(payload.timezone);

                await axios
                    .post(payload.url, {
                        first_name: payload.first_name,
                        last_name: payload.last_name,
                        email: payload.email,
                        password: payload.password,
                        password_confirmation: payload.password_confirmation,
                        timezone: payload.timezone
                    })
                    .then(response => {
                        // console.log(response);
                        // router.push({path: '/student/main'});
                        window.location = '/student/details'
                    })
            },
            openLoginPage({state, commit}, payload){

                router.push({name: 'student-loginlike', params: {id: payload.event_id}});
                commit('closeDialogForLoginToLike');

            },
        // loginPageToLike({commit}, payload){

        //     console.log(payload.event_id);
        //     router.push({name: 'student-login', params: {id: payload.event_id}});
            
        // }

    }
}