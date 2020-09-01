<template>
  <v-data-table dense :headers="headers" :items="desserts" item-key="name" class="elevation-1"></v-data-table>
</template>

<script>
export default {
    data: () => {
        return {
            selected: [],
            headers: [
            {
                text: 'Country Name',
                align: 'start',
                sortable: false,
                value: 'country',
            },
            { text: 'Total', value: 'total' },
            ],
            allerror: []
        }
    },
}
</script>

<style>

</style>