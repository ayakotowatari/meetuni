<template>
  <div>
    <v-form ref="form">
        <v-row justify="center" class="mt-12">
            <v-col col="12" sm="12" md="8">
                <h3 class="py-0">Description</h3>
            </v-col>  
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="8">
            <div class="mb-8">
                {{ event.description }}
            </div>
            <v-textarea
                v-model="description"
                counter
                label="Event Description"
                outlined
                rows="10"
                prepend-icon="mdi-pencil-outline"
                :rules="textareaRules"
                :error="allerror.description"
                :error-messages="allerror.description"
            ></v-textarea>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col col="12" sm="12" md="8">
                <v-btn 
                depressed 
                color="primary" 
                class="mx-0" 
                @click="updateDescription"
                :loading="loading"
                >Save
                </v-btn>
            </v-col>
        </v-row>
    </v-form>
    <v-form ref="form">
    <v-row justify="center">
        <v-col col="12" sm="12" md="8">
            <h3 class="py-0">Event Image</h3>
        </v-col>  
    </v-row>
    <v-row justify="center">
        <v-col col="12" sm="12" md="8">
            <v-img :src="`/storage/${ event.files }`" aspect-ratio="1.7"></v-img>
        </v-col>
    </v-row>
    <v-row justify="center">
        <v-col col="12" sm="12" md="8" class="py-0">
            <v-btn @click="hideFiles = !hideFiles" color="primary" outlined class="py-0">Change</v-btn>
            <v-btn v-if="!hideFiles" @click="updateFiles" class="ml-4" color="primary" outlined>Save</v-btn>
        </v-col>
    </v-row>
    <v-row justify="center">
        <v-col col="12" sm="12" md="8">
        <v-file-input 
            v-if="!hideFiles"
            v-model="files"
            accept="image/*" 
            label="Event Image"
            outlined
            placeholder="Pick an image"
            prepend-icon="mdi-camera-outline"
            :rules="imageRules"
            :error="allerror.image"
            :error-messages="allerror.image">
        </v-file-input>
        </v-col>
    </v-row>
    </v-form>
    <!-- <v-row justify="center">
        <v-col col="12" sm="12" md="1" offset-md="7">
            <v-btn 
            :disabled="!valid"
            depressed 
            block 
            color="primary" 
            class="mx-0 mt-3" 
            @click="submit"
            >Save
            </v-btn>
        </v-col>
        </v-row> -->
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
    props: {
        id: Number,
        event: Object
        // description: String,
        // files: String

    },
    data: () => ({
        loading: false,
        hideFiles: true,
        textareaRules: [v => v.length <= 600 || 'Max 600 characters'],
        imageRules: [
            value => !value || value.size < 3000000 || 'Image size should be less than 3 MB.',
        ],
        allerror: [],
    }),
    mounted(){
        // this.$store.dispatch('fetchSingleEvent', {
        //     id: this.id
        // });
    },
    computed: {
        // ...mapState ([
        //     'description',
        //     'files'
        // ]),
        description: {
            get(){
                return this.$store.state.event.description
            },
            set (value) {
                this.$store.commit('updateEventDescription', value)
            }
        },
        files: {
            get(){
                return this.$store.state.event.files
            },
            set(value){
                this.$store.commit('updateEventFiles', value)
            }
        }
    },
    methods: {
        ...mapActions([
            'updateEventDescription',
            'updateEventFiles'
        ]),
        updateDescription(){
            if(this.$refs.form.validate()){
                this.updateEventDescription({
                id: this.id,
                description: this.description
                })
            }
        },
        updateFiles(){
            if(this.$refs.form.validate()){
                this.updateEventFiles({
                    id: this.id,
                    image: this.files
                })
            }
        },
        // updateDescription(){

        //     if(this.$refs.form.validate()){
        //         // this.loading = true;
        //         axios
        //             .post('/inst/update-description', {
        //                 id: this.id,
        //                 description: this.description
        //             })
        //             .then(response => {
        //             this.loading = false;
        //             // this.$emit('basicsAdded');
        //             })
        //             .catch(error => 
        //                 this.allerror = error.response.data.errors
        //             )
        //     }
        // },
        
    },
   
    
}
</script>

<style>

</style>