<template>
  <div>
       <v-row justify="center">
          <v-col cols="12" sm="12" md="8">
               <h2 class="grey--text text--darken-1">Step 3</h2>
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
        </v-row>
  </div>
</template>

<script>
export default {
    data: () => ({
        valid: true,
        loading: false,
        description: '',
        textareaRules: [v => v.length <= 300 || 'Max 300 characters'],
        files: [],
        imageRules: [
            value => !value || value.size < 3000000 || 'Image size should be less than 3 MB.',
        ],
        allerror: [],
    }),
    methods: {
        validate(){
            if(
                this.description != '' && 
                this.files != '' 
            )
            {
                return true
            }else{
                return false
            }
        },
        submit(){
            if(this.valid=true){
            this.loading = true;

            let data = new FormData();
            data.append("description", this.description);
            data.append("image", this.files);

            let config = {headers: {'Content-Type': 'multipart/form-data'}};
            
            axios
                .post("/inst/create-file", data, config)
                .then(response => {
                    this.loading = false;
                    this.$emit('eventAdded');
                    this.description='';
                    this.files='';
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