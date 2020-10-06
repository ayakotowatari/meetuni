<template>
    <nav>
        <v-app-bar
            flat app color="white"
        >
            <v-toolbar-title>
            <span class="font-weight-bold primary--text">meet<span class="font-weight-light">Uni</span><span class="font-weight-bold info--text darken-3">Institution</span></span> 
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn text color="grey darken-1" @click.stop="toTopPage">
                <span>top page</span>
            </v-btn>
            <!-- <v-btn text color="grey darken-1" @click.stop="toContact">
                <span>contact</span>
            </v-btn> -->
            <v-btn 
                text color="primary" 
                @click.stop="toLogin"
            >
                <span>Log in</span>
            </v-btn>
        </v-app-bar>
    </nav>
</template>

<script>
import { mapState } from 'vuex'

export default {
    props: {
        
    },
    data: () => ({
       
    }),
    mounted() {
        
    },
    computed: {
        
    },
    methods: {
        toTopPage(){
            window.location = "/institution"
        },
        toLogin(){
            window.location = "/institution/login"
        },
        // toContact(){
        //     window.location = "/institution/contact";
        // }
        
    }
}
</script>