<template>
<v-form>
  <v-row justify="center">
              <v-col col="12" sm="12" md="8">
                <v-select
                    v-model="selectedRegions"
                    :items="regions"
                    item-text="region"
                    item-value='id'
                    label="Regions"
                    :rules="regionRules" 
                    multiple
                    chips
                    prepend-icon="mdi-globe-model"
                    hint="What are target regions?"
                    persistent-hint
                    required
                    :error="allerror.regions"
                    :error-messages="allerror.regions"
                ></v-select>
              </v-col>
            </v-row>
            <v-btn @click="submit"></v-btn>
    </v-form>
</template>

<script>
export default {
    props: {
    levels: Array,
    subjects: Array,
    regions: Array,
  },
  data: () => ({
    valid: true,
    selectedRegions: [],
    regionRules: [
       v => !!v || 'Region is required',
    ],
    allerror: []
  }),
  methods: {
      submit(){
          let selected = this.selectedRegions;
          console.log(selected);

          axios
          .post('/inst/region',
              {
                regions:this.selectedRegions
              })
              .then(response => {
                    this.selectedRegions='';
              })
              .catch(err => {
                  this.message = err;
              })

          // let data = new FormData();
          // data.append('regions', this.SelectedRegions);
          
          // axios
          // .post('/inst/region', data)
          //     .then(response => {
          //           this.selectedRegions='';
          //     })
          //     .catch(err => {
          //         this.message = err;
          //     })
      }
  }

}
</script>

<style>

</style>