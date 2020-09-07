<template>
  
</template>

<script>
import {createNamespacedHelpers} from 'vuex'
const { mapState } = createNamespacedHelpers('student');

export default {
    data: function(){
        return{
            id: this.$route.params.id,
        }
        console.log(id);
    },
    mounted(){
        this.$store.dispatch('fetchSingleEvent', {
            id: this.id
        })
    },
    computed: {
        ...mapState([
            'event'
        ])
    }


}
</script>

<style>

</style>