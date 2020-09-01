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
                   // console.log(response.data.country);
                   // console.log(response.data.total);
                   let countries = response.data.countries;
                   let country = response.data.country;
                   let total = response.data.total;
                //    let country = response.data.country;
                //    let total = response.data.total;
                //    console.log(country);
                //    console.log(total);

                   commit('setParticipantCountry', {countries, country, total})
                   
                //    this.chartdata = {
                //        labels: country,
                //        datasets: [{
                //            data: total,
                //            backgroundColor: [
                //                "#6A2B86",
                //                "#F0E52F",
                //                "#1ABEBE",
                //                "#ED871D",
                //                "#DF3291",
                //                "#66266C",
                //            ],
                //            borderAlign: "inner"
                //        }]
                //    }
                //    this.loaded = true
                //    this.$emit('isBooked');
               })
            //    .catch(error => {
            //    console.error(error);
            //    })
               // .finally(() => this.loaded = true)
       },
    }

}