<template>
  <div class="container">
        <div class="row justify-content-center mb-3" ref="ImageUpload">
            <div class="col-12 rounded py-3 my-2 text-center text-dark  bg-warning h5 font-weight-bold mt-3">DROP IMAGE(S) HERE</div>
        </div>
    </div>
</template>

<script>
 import Dropzone from 'dropzone';

    export default { 

        data: function () {
            return {
                dropzone: null
            }
        },

        mounted() {
            this.dropzone = new Dropzone(this.$refs.ImageUpload, {
                url: '/api/images'
           });
        }

        
    }
</script>

<style>

</style>