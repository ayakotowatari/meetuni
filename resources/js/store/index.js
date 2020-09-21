import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import router from '../router'

import { participants } from './modules/participants';
import { participantcharts } from './modules/participantcharts';
import { student } from './modules/student';
import { studentaccount } from './modules/studentaccount';
import { notifications } from './modules/notifications';

export default new Vuex.Store ({

    state: {
        //状態を管理する
        //component側でstateからデータを取るのはcomputed
        user: {},
        inst: {},
        initials: '',
        events: [],
        regions: [],
        levels: [],
        subjects: [],
        event: {},
        title: '',
        date: '',
        timezone: '',
        start_time: '',
        end_time: '',
        start_utc: '',
        end_utc: '',
        description: '',
        files: '',
        eventRegions: [],
        eventLevels: [],
        eventSubjects: [],
        members: [],
        memberId: '',
        dialog: false,
        loading: false,
        isPublished: false,
        isOngoing: false,
        isDraft: false,

        //学生用に追加
        studentUser: {},
        countries: [],
        destinations: [],
        years: [],
        // participants:[],
        //テスト
        // details: {
        //     id: [],
        //     name: [],
        //     email: []
        // },
        allerror: [],
    },
    getters: {
        //stateの値を加工して、componentで使いたい時。
        //componentsではcomputedで展開
        filterCountries: (state) => (id) => {
            return state.countries.filter(countries => countries.region_id == id)
        }
    },
    mutations: {
        //actionsが終わった後の同期処理をする
        //change and edite data in state
        //componentsではmethodsで展開
        setUser(state, payload){
            state.user = payload
        },
        setInst(state, payload){
            state.inst = payload
        },
        setInitials(state, payload){
            state.initials = payload
        },
        setEvents(state,payload){
            state.events = payload
        },
        setRegions(state,payload){
            state.regions = payload
        },
        setLevels(state,payload){
            state.levels = payload
        },
        setSubjects(state,payload){
            state.subjects = payload
        },
        setSingleEvent(state,payload){
            state.event = payload
            state.title = payload.title
            state.date = payload.date
            state.timezone = payload.timezone
            state.start_time = payload.start_time
            state.end_time = payload.end_time
            state.start_utc = payload.start_utc
            state.end_utc = payload.end_utc
            state.description = payload.description
            state.files = payload.image
        },
        setEventRegions(state, payload){
            state.eventRegions = payload
        },
        setEventLevels(state, payload){
            state.eventLevels = payload
        },
        setEventSubjects(state, payload){
            state.eventSubjects = payload
        },
        updateEventDescription(state, payload){
            state.description = payload
        },
        updateEventFiles(state, payload){
            state.files = payload
        },
        updateEventTitle(state,payload){
            state.title = payload
        },
        updateEventDate(state,payload){
            state.date = payload
        },
        updateEventTimezone(state,payload){
            state.timezone = payload
        },
        updateEventStartTime(state,payload){
            state.start_time = payload
        },
        updateEventEndTime(state,payload){
            state.end_time= payload
        },
        setallErrors(state, payload){
            state.allerror = payload
        },
        showDialog(state){
            state.dialog = true;
        },
        closeDialog(state){
            state.dialog = false;
        },
        isPublished(state){
            state.isPublished = true;
        },
        isUnpublished(state){
            state.isPublished = false;
        },
        isOngoing(state){
            state.event.status = 'Ongoing';
        },
        isDraft(state){
            state.event.status = 'Draft';
        },
        startLoading(state){
            state.loading = true;
        },
        stopLoading(state){
            state.loading = false;
        },
        setMembers(state, payload){
            state.members = payload;
        },
        setMemberId(state, payload){
            state.memberId = payload
        },

        //学生用に追加
        setStudentUser(state, payload){
            state.studentUser = payload
        },
        setCountries(state,payload){
            state.countries = payload
        },
        setDestinations(state,payload){
            state.destinations = payload
        },
        setYears(state,payload){
            state.years = payload
        },
        // setParticipants(state, payload){
        //     state.participants = payload
        // }
        //テスト
        // readDetails(state, payload){
        //     state.details.id = payload.id
        //     state.details.name = payload.name
        //     state.details.email = payload.email
        // },
        // setDetails(state, payload){  
        //     state.details = Object.assign({}, state.details, payload)
        // },
        // updateName(state, payload){
        //     state.details.name = payload
        // },
        // updateEmail(state, payload){
        //     state.details.email = payload
        // }
    },
    actions: {
        //非同期処理をする
        //componentsではmethodsで展開

        async fetchUser({ commit }){
            let payload = [];

            await axios
                .get("/inst/fetch-user")
                .then(res => {
                    payload = res.data.user;
                    commit('setUser', payload)
            });
        },
        async fetchInst({ commit }) {
            let payload = [];

            await axios
                .get("/inst/fetch-inst")
                .then(res => {
                    payload = res.data.inst;
                    commit('setInst', payload)
            });
        },
        async fetchInitials({ commit }) {
            let payload = '';

            await axios
                .get("/inst/fetch-initials")
                .then(res => {
                    payload = res.data.initials;
                    commit('setInitials', payload)
            });
        },
        async fetchEvents({commit}) {
            let payload = [];
            await axios
                .get("/inst/fetch-events")
                .then(response => {
                    payload = response.data.events;
                    commit("setEvents", payload)
                });
        },
        async fetchRegions({commit}) {
            let payload = [];
            await axios
                .get("/inst/fetch-regions")
                .then(res => {
                payload = res.data.regions;
                commit("setRegions", payload)
                })
        },
        async fetchLevels({commit}) {
            let payload = [];
            await axios
                .get("/inst/fetch-levels")
                .then(res => {
                  payload = res.data.levels;
                  commit("setLevels", payload)
                })
        },
        async fetchSubjects({commit}) {
            let payload = [];
            await axios
                .get("/inst/fetch-subjects")
                .then(res => {
                  payload = res.data.subjects;
                  commit("setSubjects", payload)
                })
        },
        async fetchSingleEvent({commit}, payload){
            // console.log(payload.id);

            let event = [];

            await axios
                .get("/inst/fetch-single-event/" + payload.id)
                .then(res => {
                event = res.data.event;
                commit("setSingleEvent", event)
                })
        },
        async fetchEventRegions({commit}, payload){
            // console.log(payload.id);

            let eventRegions = [];

            await axios
                .get("/inst/fetch-event-regions/" + payload.id)
                .then(res => {
                eventRegions = res.data.eventRegions;
                commit("setEventRegions", eventRegions)
            })
        },
        async fetchEventLevels({commit}, payload){
            // console.log(payload.id);

            let eventLevels = [];

            await 
                axios
                .get("/inst/fetch-event-levels/" + payload.id)
                .then(res => {
                    eventLevels = res.data.eventLevels;
                    commit("setEventLevels", eventLevels)
                })
        },
        async fetchEventSubjects({commit}, payload){
            // console.log(payload.id);

            let eventSubjects = [];

            await axios
                .get("/inst/fetch-event-subjects/" + payload.id)
                .then(res => {
                    eventSubjects = res.data.eventSubjects;
                    commit("setEventSubjects", eventSubjects)
                })
        },
        async updateEventBasics({state, commit}, payload){

            let loading = payload.loading
            let allerror = [];

            axios
                .post("/inst/update-basics", {
                    id: payload.id,
                    title: payload.title,
                    date: payload.date,
                    timezone: payload.timezone,
                    start_time: payload.start_time,
                    end_time: payload.end_time
                })
                .then(response => {
                    loading = false;
                    // this.$emit('basicsAdded');
                })
                .catch(error => 
                    allerror = error.response.data.errors,
                    commit("setallErrors", allerror)
                )
        },
        async updateEventDescription({state, commit}, payload){

            console.log(payload.id);
            console.log(payload.description);

            await axios
                    .post('/inst/update-description', {
                        id: payload.id,
                        description: payload.description
                    })
                    .then(response => {
                        console.log(response);
                    // this.$emit('basicsAdded');
                    })
                    .catch(error => 
                        allerror = error.response.data.errors,
                        commit('setallErrors', allerror)
                    )

        },
        async updateEventFiles({state, commit}, payload){

            console.log(payload.id);
            console.log(payload.image);

            let allerror = [];
            
            let data = new FormData();
            data.append("image", payload.image);
            data.append("id", payload.id)

            let config = {headers: {'Content-Type': 'multipart/form-data'}};
            
            await axios
                .post("/inst/update-image", data, config)
                .then(response => {
                    console.log(response);
                    // this.loading = false;
                    // this.$emit('eventAdded');
                })
                // .catch(error => 
                //     this.allerror = error.response.data.errors
                // );
                .catch(error => 
                        allerror = error.response.data.errors,
                        commit('setallErrors', allerror)
                    )
        },
        async publishEvent({state, commit}, payload){
            console.log(payload.id);
            await axios
              .post('/inst/publish-event/' + payload.id)
              .then(res => {
                console.log(res);
                commit('showDialog');
                commit('isPublished');
                commit('isOngoing');
              })
        },
        async unpublishEvent({state, commit}, payload){

            await axios
              .post('/inst/unpublish-event/' + payload.id)
              .then(res => {
                console.log(res);
                commit('isUnpublished');
                commit('showDialog');
                commit('isDraft');
              })
        },
        toDashboardPage({state, commit}, payload){
            router.push({name: 'dashboard', params: {id: payload.id}});
            commit('closeDialog');
        },
        toMyEventsPage({state,commit}){
            router.push({ name: 'events'});
            commit('closeDialog');
        },
        async inviteMembers({state, commit}, payload){

            commit('startLoading');
            let allerror = [];

            await axios
                .post('/inst/invite-members', {  
                user_id: payload.user_id,
                inst_id: payload.inst_id,
                first_name: payload.first_name,
                last_name: payload.last_name,
                email: payload.email,
                job_title: payload.job_title,
                department: payload.department
            })
            .then(response => {
                commit('stopLoading');
                commit('showDialog');
            })
            .catch(error => 
                allerror = error.response.data.errors,
                commit('setallErrors', allerror)
            )
        },
        toAddMembers({state, commit}){
            router.go()
            commit('closeDialog');
        },
        toTeam({state,commit}){
            router.push({ name: 'inst-team'});
            commit('closeDialog');
        },
        async fetchTeamMembers({state, commit}){

            let members = [];

            await axios
                .get('/inst/fetch-members/')
                .then(response => {
                    members = response.data.members;
                    commit('setMembers', members);
                })
        },
        showDeleteMemberDialog({state,commit}, payload){

            let member_id = payload.member_id;

            commit('showDialog');
            commit('setMemberId', member_id);

        },
        async deleteTeamMembers({state,commit}, payload){

            // let members = [];

            await axios
                .post('/inst/delete-members/' + payload.id)
                .then(response => {
                    // members = response.data.members,
                    // commit('setMembers', payload)
                    commit('closeDialog');
                    router.go();
                })

        },


        //学生用に追加
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
        async fetchCountries({commit}) {
            let payload = [];

            await axios
                .get("/student/fetch-countries")
                .then(res => {
                    payload = res.data.countries;
                    commit("setCountries", payload)
                })
        },
        async fetchDestinations({commit}) {
            let payload = [];

            await axios 
                .get("/student/fetch-destinations")
                .then(res => {
                    payload = res.data.destinations;
                    commit("setDestinations", payload)
                })
        },
        async fetchYears({commit}){
            let payload = [];

            await axios
                .get("/student/fetch-years")
                .then(res => {
                    payload = res.data.years;
                    commit("setYears", payload)
                })
        },
        async addStudentDetails({state, commit}, payload){
            let allerror = [];

            console.log(payload.id);
            console.log(payload.country);
            console.log(payload.year);
            console.log(payload.destinations);
            console.log(payload.levels);
            console.log(payload.subjects);

            await axios 
                .post("/student/add-details", {
                    id: payload.id,
                    country: payload.country,
                    year: payload.year,
                    destinations: payload.destinations,
                    levels: payload.levels,
                    subjects: payload.subjects
                })
                .then(response => {
                    console.log(response)
                })
                .catch(error => 
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                )
        },

        //テスト
        // async readDetails({commit}){

        //     await axios
        //         .get('/inst/testform')
        //         .then(res => {
        //         //   let id = res.data.testform.id;
        //         //   let name = res.data.testform.name;
        //         //   let email = res.data.testform.email;
        //         let details = res.data.testform
        //           commit("readDetails", details)
        //         })
            
        // },
        // async postDetails({state, commit}, payload){
        //     console.log(payload.name);
        //     console.log(payload.email);

        //     let allerror = [];

        //     const details = {
        //         name: payload.name,
        //         email: payload.email
        //     }

        //     await axios
        //         .post('/inst/testform', {
        //             name: details.name,
        //             email: details.email
        //         })
        //         .then(response => {
        //             console.log(response)
        //         })
        //         .catch(error => 
        //             allerror = error.response.data.errors,
        //             console.log(allerror),
        //             commit('setallErrors', allerror)
        //         )
        // },
        // async updateDetails({state, commit}, payload){
        //     console.log(payload.name);
        //     console.log(payload.email);

        //     let allerror = [];

        //     const details = {
        //         name: payload.name,
        //         email: payload.email
        //     }

        //     await axios
        //         .post('/inst/testform/update', {
        //             name: details.name,
        //             email: details.email
        //         })
        //         .then(response => {
        //             console.log(response)
        //         })
        //         .catch(error => 
        //             allerror = error.response.data.errors,
        //             console.log(allerror),
        //             commit('setallErrors', allerror)
        //         )
        // }
    },
    modules: {
        participants,
        participantcharts,
        student,
        studentaccount,
        notifications
    }

})