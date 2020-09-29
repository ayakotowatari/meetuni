export const studentdetails = {
    namespaced: true,

    state: {
        regions: [],
        countries: [],
        levels: [],
        destinations: [],
        subjects: [],
        years: [],
        allerror: []
        
    },
    getters: {
        //stateの値を加工して、componentで使いたい時。
        //componentsではcomputedで展開
        filterCountries: (state) => (id) => {
            return state.countries.filter(countries => countries.region_id == id)
        }
    },
    mutations: {
        setRegions(state,payload){
            state.regions = payload
        },
        setLevels(state,payload){
            state.levels = payload
        },
        setSubjects(state,payload){
            state.subjects = payload
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
       
       
    },
    actions: {
        async fetchRegions({commit}) {
            let payload = [];
            await axios
                .get("/student/fetch-regions")
                .then(res => {
                payload = res.data.regions;
                commit("setRegions", payload)
                })
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
        async fetchLevels({commit}) {
            let payload = [];
            await axios
                .get("/student/fetch-levels")
                .then(res => {
                  payload = res.data.levels;
                  commit("setLevels", payload)
                })
        },
        async fetchSubjects({commit}) {
            let payload = [];
            await axios
                .get("/student/fetch-subjects")
                .then(res => {
                  payload = res.data.subjects;
                  commit("setSubjects", payload)
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

            // console.log(payload.id);
            // console.log(payload.country);
            // console.log(payload.year);
            // console.log(payload.destinations);
            // console.log(payload.levels);
            // console.log(payload.subjects);

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
                    // console.log(response)
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    // console.log(allerror),
                    commit('setallErrors', allerror)
                })
        },




    }

}