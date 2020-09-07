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
        this.$store.dispatch('student/fetchSingleEvent', {
            id: this.id
        })
    },
    computed: {
        ...mapState([
            'event',
            'regions',
            'levels',
            'subjects'
        ])
    }


}
</script>

<style>

</style>