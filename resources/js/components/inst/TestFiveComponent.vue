<template>
  <div>
      {{ title }}
      {{ date }}
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
    data: function(){
        return{
            id: 5
        }
    },
    mounted(){
        this.$store.dispatch('fetchSingleEvent', {
            id: this.id
        })
    },
    computed: {
        ...mapState([
            'title',
            'date'
        ])
    }

}
</script>

<style>

</style>