<template>
  <div v-if="hideFile == false">
        <v-row justify="center">
            <v-dialog v-model="dialog" persistent max-width="420">
            <v-card>
                <v-card-title class="headline">You added a new project.</v-card-title>
                <v-card-text>Now it's time to publish your event informatoin to reach students.</v-card-text>
                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="info darken-2" text @click="toDraft(event.id)">Go to Draft</v-btn>
                <v-btn color="info darken-2" text @click="toMyEvents">Back to My Events</v-btn>
                </v-card-actions>
            </v-card>
            </v-dialog>
        </v-row>
       <v-row justify="center">
          <v-col cols="12" sm="12" md="8">
               <h2 class="grey--text text--darken-1">Step 3</h2>
          </v-col>
      </v-row>
      <v-form :disabled="hideFile" class="mb-6" ref="form">
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
                <v-col col="12" sm="12" md="8">
                <v-file-input 
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
            <v-row justify="center">
                <v-col col="12" sm="12" md="8">
                    <v-btn 
                        :disabled = "fileIsSubmitted"
                        depressed 
                        class="mr-3"
                        color="primary" 
                        @click="submit"
                        :loading="loading"
                    >Save
                    </v-btn>
                </v-col>
            </v-row>
        </v-form>
  </div>
</template>

<script>
export default {
    props: {
        hideFile: Boolean
    },
    data: () => ({
        id: '',
        fileIsSubmitted: false,
        dialog: false,
        loading: false,
        description: '',
        textareaRules: [
            v => !!v || v.length <= 300 || 'Max 300 characters'
        ],
        files: [],
        imageRules: [
            value => !!value || value.size < 3000000 || 'Image size should be less than 3 MB.',
        ],
        allerror: [],
    }),
    methods: {
        // validate(){
        //     if(
        //         this.description != '' && 
        //         this.files != '' 
        //     )
        //     {
        //         return true
        //     }else{
        //         return false
        //     }
        // },
        submit(){
            if(this.$refs.form.validate()){
            this.loading = true;

            let data = new FormData();
            data.append("description", this.description);
            data.append("image", this.files);

            let config = {headers: {'Content-Type': 'multipart/form-data'}};
            
            axios
                .post("/inst/create-file", data, config)
                .then(response => {
                    this.loading = false;
                    this.event = response.data.event;
                    this.dialog = true;
                })
                // .catch(error => 
                //     this.allerror = error.response.data.errors
                // );
                .catch(error => {
                        this.allerror = error.response.data.errors
                    })
            }
        },
        toDraft(id){
            this.$router.push({name: 'edit-events', params: {id: id}})
        },
        toMyEvents(){
            this.$router.push({name: 'events'})
        }
    },
    
}
</script>

<style>

</style>