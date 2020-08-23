<template>
<div>
  <v-file-input 
  v-model="files"
  accept="image/*" 
  label="File input"
  placeholder="Pick an avatar"
  prepend-icon="mdi-camera"
  :rules="imageRules"
  :error="allerror.image"
  :error-messages="allerror.image">
  </v-file-input>

  <!-- <v-file-input
    v-model="files"
    accept="image/*"
    placeholder="Pick an avatar"
    prepend-icon="mdi-camera"
    label="Avatar"
    :error="allerror.image"
    :error-messages="allerror.image"
  ></v-file-input> -->
   <v-btn 
    depressed 
    block 
    color="primary" 
    class="mx-0 mt-3" 
    @click="submit"
    >Add project
    </v-btn>
    <v-img :src="`/storage/${image.image}`"></v-img>
</div>
</template>

<script>
 export default {
    data: () => ({
      image: {},
      files: [],
      imageRules: [
        value => !value || value.size < 3000000 || 'Image size should be less than 3 MB.',
      ],
      allerror: [],
    }),
    created(){
      this.fetchImage()
    },
    methods: {
    fetchImage: function(){
        axios.get('/inst/image/get').then(res => {
            this.image = res.data.image;
          })
    },
    submit(){
          let data = new FormData();
          data.append("image", this.files);

          // const requestOptions = {
          // method: "POST", 
          // headers: {'Content-Type': 'multipart/form-data'},
          // body: data
          // };
          // fetch("/inst/test/store", requestOptions)
          // .then(response => {
          //     this.file=''
          // })
          // .catch(error => 
          //   this.allerror = error.response.data.errors
          // )

          let config = {headers: {'Content-Type': 'multipart/form-data'}};
          axios
            .post("/inst/test/store", data, config)
            .then(response => {
                this.file='';
            })
            // .catch(error => 
            //     this.allerror = error.response.data.errors
            // );
            .catch(error => 
                    this.allerror = error.response.data.errors
                )

         
        }
      }
  }
</script>

<style>

</style>