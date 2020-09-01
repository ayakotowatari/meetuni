export const participantcharts = {
    namespaced: true,

    state: {
        countries: [],
        country: [],
        total: []

    },
    mutations: {
        setParticipantCountry(state, payload){
            state.countries = payload.countries
            state.country = payload.country
            state.total = payload.total
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
    }

}