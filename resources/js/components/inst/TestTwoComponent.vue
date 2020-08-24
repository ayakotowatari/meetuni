<template>
   <v-container fluid>
    <v-form>
    <v-row align="center">
      <v-col cols="12" sm="6">
        <v-select
          v-model="e6"
          :items="states"
          :menu-props="{ maxHeight: '400' }"
          label="Select"
          multiple
          hint="Pick your favorite states"
          persistent-hint
        ></v-select>
      </v-col>
      <v-col cols="12" sm="6">
        <v-select
          v-model="e7"
          :items="states"
          label="Select"
          multiple
          chips
          hint="What are the target regions"
          persistent-hint
        ></v-select>
      </v-col>
    </v-row>
    <v-btn @click="submit"></v-btn>
    </v-form>
  </v-container>
</template>

<script>
export default {
data () {
      return {
        e6: [],
        e7: [],
        states: [
          'Alabama', 'Alaska', 'American Samoa', 'Arizona',
          'Arkansas', 'California', 'Colorado', 'Connecticut',
          'Delaware', 'District of Columbia', 'Federated States of Micronesia',
          'Florida', 'Georgia', 'Guam', 'Hawaii', 'Idaho',
          'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky',
          'Louisiana', 'Maine', 'Marshall Islands', 'Maryland',
          'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi',
          'Missouri', 'Montana', 'Nebraska', 'Nevada',
          'New Hampshire', 'New Jersey', 'New Mexico', 'New York',
          'North Carolina', 'North Dakota', 'Northern Mariana Islands', 'Ohio',
          'Oklahoma', 'Oregon', 'Palau', 'Pennsylvania', 'Puerto Rico',
          'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee',
          'Texas', 'Utah', 'Vermont', 'Virgin Island', 'Virginia',
          'Washington', 'West Virginia', 'Wisconsin', 'Wyoming',
        ],
      }
},
methods: {
    submit(){
        let obtainedData01 = this.e6;
        let obtainedData02 = this.e7;

        console.log(obtainedData01);
        console.log(obtainedData02);
    }
}
}
</script>

<style>

</style>