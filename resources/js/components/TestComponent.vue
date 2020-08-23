<template>
<v-form>
  <v-file-input
    v-model="files"
    :rules="rules"
    accept="image/png, image/jpeg, image/bmp"
    placeholder="Pick an avatar"
    prepend-icon="mdi-camera"
    label="Avatar"
    :error="allerror.image"
    :error-messages="allerror.image"
  ></v-file-input>
   <v-btn 
    depressed 
    block 
    color="primary" 
    class="mx-0 mt-3" 
    @click="submit"
    >Add project
    </v-btn>
</v-form>
</template>

<script>
 export default {
    data: () => ({
      rules: [
        value => !value || value.size < 3000000 || 'Avatar size should be less than 3 MB!',
      ],
      files: [],
      allerror: [],
    }),
    methods: {
    submit(){
          let data = new FormData();
          data.append("image", this.files[0]);

          const requestOptions = {
          method: "POST", 
          headers: {'Content-Type': 'multipart/form-data'},
          body: data
          };
          fetch("/inst/test/store", requestOptions)
          .then(response => {
              this.file=''
          })
          .catch(error => 
            this.allerror = error.response.data.errors
          )

          // let config = {headers: {'Content-Type': 'multipart/form-data'}};
         
          // axios
          //   .post("/inst/test/store", data, config)
          //   .then(response => {
          //       this.file='';
          //   })
          //   // .catch(error => 
          //   //     this.allerror = error.response.data.errors
          //   // );
          //   .catch(error => 
          //           this.allerror = error.response.data.errors
          //       )

         
        }
      }
  }
</script>

<style>

</style>