<template>
   <v-menu offset-y>
    <template v-slot:activator="{ on, attrs }">
        <v-btn 
        depressed 
        class="grey--text"
        v-bind="attrs"
        v-on="on">
            <v-icon left>mdi-chevron-down</v-icon>
            <span>Menu</span>
        </v-btn>
    </template>
    <v-list>
        <v-list-item v-for="link in links" :key="link.text" router :to="link.route">
            <v-list-item-title>
                {{ link.text }}
            </v-list-item-title>
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
    offset: true
}
</script>

<style>

</style>