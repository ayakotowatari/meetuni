<template>
    <v-app>
        <v-container>
        <v-row>
            <v-col>
            <v-card class="mx-auto">
                <v-card-text>
                <p class="text--primary">
                    Hello Vuetify World!!
                </p>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                <v-btn>やったね！！</v-btn>
                </v-card-actions>
                <v-icon medium>mdi-home</v-icon>
            </v-card>
            </v-col>
        </v-row>
        </v-container>
    </v-app>
    <!-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
