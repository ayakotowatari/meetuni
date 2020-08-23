<template>
   <v-menu bottom left offset-y>
            <template v-slot:activator="{ on, attrs }">
                <v-btn 
                    text 
                    color="grey darken"
                    v-bind="attrs"
                    v-on="on"
                >
                <v-icon left>mdi-chevron-down</v-icon>
                <span>Menu</span>
                </v-btn>
            </template>

            <v-list>
                <v-list-item
                v-for="(item, i) in items"
                :key="i"
                >
                <v-list-item-title>{{ item.title }}</v-list-item-title>
                </v-list-item>
            </v-list>
          </v-menu>
         
</template>

<script>
export default {
    name: 'DashboardMenu',
    items: [
            { title: 'Click Me' },
            { title: 'Click Me' },
            { title: 'Click Me' },
            { title: 'Click Me 2' },
    ],
}
</script>

<style>

</style>