<template>
  <div>
    <v-form v-model="valid">
        <v-row justify="center" class="mt-12">
            <v-col col="12" sm="12" md="8">
                <h3 class="py-0">Description</h3>
            </v-col>  
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="8">
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
            <v-col col="12" sm="12" md="1" offset-md="7">
                <v-btn 
                :disabled="!valid"
                depressed 
                block 
                color="primary" 
                class="mx-0" 
                @click="updateDescription"
                :loading="loading"
                >Save
                </v-btn>
            </v-col>
        </v-row>
    </v-form>
    <v-form v-model="valid">
    <v-row justify="center">
        <v-col col="12" sm="12" md="8">
            <h3 class="py-0">Event Image</h3>
        </v-col>  
    </v-row>
    <v-row justify="center">
        <v-col col="12" sm="12" md="8">
            <v-img :src="`/storage/${ files }`" aspect-ratio="1.7"></v-img>
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
export default {
    props: {

        id: String,
        description: String,
        files: String

    },
    data: () => ({
        valid: true,
        loading: false,
        hideFiles: true,
        textareaRules: [v => v.length <= 600 || 'Max 600 characters'],
        imageRules: [
            value => !value || value.size < 3000000 || 'Image size should be less than 3 MB.',
        ],
        allerror: [],
    }),
    methods: {
        validate(){
            if(
                this.description != ''
            )
            {
                return true
            }else if(
            
                this.files != ''
            
            )
            {
                return true
            }
            else{
                
                return false
            }
        },
        updateDescription(){

            if(this.valid=true){
                this.loading = true;

                axios
                    .post('/inst/update-description', {
                        id: this.id,
                        description: this.description
                    })
                    .then(response => {
                    this.loading = false;
                    // this.$emit('basicsAdded');
                    })
                    .catch(error => 
                        this.allerror = error.response.data.errors
                    )
            }
        },
        updateFiles(){
            if(this.valid=true){
            this.loading = true;

            let data = new FormData();
            data.append("image", this.files);
            data.append("id", this.id)

            let config = {headers: {'Content-Type': 'multipart/form-data'}};
            
            axios
                .post("/inst/update-image", data, config)
                .then(response => {
                    this.loading = false;
                    // this.$emit('eventAdded');
                })
                // .catch(error => 
                //     this.allerror = error.response.data.errors
                // );
                .catch(error => 
                        this.allerror = error.response.data.errors
                    )
            }
        }
    },
    
}
</script>

<style>

</style>