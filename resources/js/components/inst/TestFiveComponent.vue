<template>
  <div>
      {{ title }}
      {{ date }}
       <div>
          {{ formattedStartTime(event.start_utc, user.timezone) }} - 
          {{ formattedEndTime(event.end_utc, user.timezone) }}
        </div>
  </div>
</template>

<script>
import { mapState, mapMutations } from 'vuex'

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
    methods: {
        ...mapMutations([
            'formattedStartTime'
        ]),
        formattedEndTime(value, timezone){
        return moment.utc(value).local().tz(timezone).format("h:mm a ([GMT] Z)")
        }
    },
    computed: {
        ...mapState([
            'user',
            'event',
            'title',
            'date',
            'start_utc',
            'end_utc'
        ])
    }

}
</script>

<style>

</style>