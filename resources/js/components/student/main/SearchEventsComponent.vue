<template>
  <v-container> 
      <v-autocomplete
      v-model="model"
      :items="items"
      :loading="isLoading"
      :search-input.sync="search"
      chips
      clearable
      hide-details
      hide-selected
      item-text="name"
      item-value="symbol"
      label="Search for an event from the university of your interest"
      solo
      outlined
      flat
      color="primary"
    >
        <template v-slot:no-data>
            <v-list-item>
              <v-list-item-title>
                Search for your favourite
                <strong>University</strong>
              </v-list-item-title>
            </v-list-item>
        </template>
        <template v-slot:selection="{ attr, on, item, selected }">
            <v-chip
              v-bind="attr"
              :input-value="selected"
              color="blue-grey"
              class="white--text"
              v-on="on"
            >
              <v-icon left>mdi-coin</v-icon>
              <span v-text="item.name"></span>
            </v-chip>
        </template>
        <template v-slot:item="{ item }">
            <v-list-item-avatar
              color="indigo"
              class="headline font-weight-light white--text"
            >
              {{ item.name.charAt(0) }}
            </v-list-item-avatar>
            <v-list-item-content>
              <v-list-item-title v-text="item.name"></v-list-item-title>
              <v-list-item-subtitle v-text="item.symbol"></v-list-item-subtitle>
            </v-list-item-content>
            <v-list-item-action>
              <v-icon>mdi-coin</v-icon>
            </v-list-item-action>
        </template>
    </v-autocomplete>
    <template>
        <v-tabs
          v-model="tab"
          :hide-slider="!model"
          color="blue-grey"
          slider-color="blue-grey" 
        >
          <v-tab :disabled="!model">News</v-tab>
          <v-tab :disabled="!model">Trading</v-tab>
          <v-tab :disabled="!model">Blog</v-tab>
        </v-tabs>
    </template>
</v-container>
</template>

<script>
export default {
data: () => ({
      isLoading: false,
      items: [],
      model: null,
      search: null,
      tab: null,
    }),

    watch: {
      model (val) {
        if (val != null) this.tab = 0
        else this.tab = null
      },
      search (val) {
        // Items have already been loaded
        if (this.items.length > 0) return

        this.isLoading = true

        // Lazily load input items
        fetch('https://api.coingecko.com/api/v3/coins/list')
          .then(res => res.clone().json())
          .then(res => {
            this.items = res
          })
          .catch(err => {
            console.log(err)
          })
          .finally(() => (this.isLoading = false))
      },
    },
}
</script>

<style>

</style>