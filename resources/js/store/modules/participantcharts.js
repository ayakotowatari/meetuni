export const participantcharts = {
    namespaced: true,

    state: {
        countries: [],
        country: [],
        totalCountry: [],
        destinations: [],
        destination: [],
        totalDestination: [],
        levels: [],
        level: [],
        totalLevel: [],
        subjects: [],
        level: [],
        totalSubject: []
    },
    mutations: {
        setParticipantCountry(state, payload){
            state.countries = payload.countries
            state.country = payload.country
            state.totalCountry = payload.total
        },
        setParticipantDestination(state, payload){
            state.destinations = payload.destinations
            state.destination = payload.destination
            state.totalDestination = payload.total
        },
        setParticipantLevel(state, payload){
            state.levels = payload.levels
            state.level = payload.level
            state.totalLevel = payload.total
        },
        setParticipantSubject(state, payload){
            state.subjects = payload.subjects
            state.subject = payload.subject
            state.totalSubject = payload.total
        }
    },

    actions: {
        async fillParticipantCountryChart({commit}, payload){
            await axios
               .get('/inst/participant-countries/' + payload.id)
               .then(response => {
                   let countries = response.data.countries;
                   let country = response.data.country;
                   let total = response.data.total;
                //    let country = response.data.country;
                //    let total = response.data.total;
                //    console.log(country);
                //    console.log(total);

                   commit('setParticipantCountry', {countries, country, total})
               })
       },
       async fillParticipantDestinationChart({commit}, payload){
            await axios
            .get('/inst/participant-destinations/' + payload.id)
            .then(response => {
                let destinations = response.data.destinations;
                let destination = response.data.destination;
                let total = response.data.total;

                commit('setParticipantDestination', {destinations, destination, total})
            })
        },
        async fillParticipantLevelChart({commit}, payload){
            await axios
            .get('/inst/participant-levels/' + payload.id)
            .then(response => {
                let levels = response.data.levels;
                let level = response.data.level;
                let total = response.data.total;

                commit('setParticipantLevel', {levels, level, total})
            })
        },
        async fillParticipantSubjectChart({commit}, payload){
            await axios
            .get('/inst/participant-subjects/' + payload.id)
            .then(response => {
                let subjects = response.data.subjects;
                let subject = response.data.subject;
                let total = response.data.total;

                commit('setParticipantSubject', {subjects, subject, total})
            })
        },
    }

}