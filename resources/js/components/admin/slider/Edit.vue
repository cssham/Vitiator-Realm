<template>
    <div>
         <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Slider</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" enctype="multipart/form-data" @submit.prevent="updateSlider()">
                <div class="card-body">
                    <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Slider Title" v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }">
                    <has-error :form="form" field="title"></has-error>
                  </div>
                  <div class="form-group">
                    <label for="name">Sub Title</label>
                    <input type="text" class="form-control" id="sub_title" name="sub_title" placeholder="Enter Slider Sub Title" v-model="form.sub_title" :class="{ 'is-invalid': form.errors.has('sub_title') }">
                    <has-error :form="form" field="sub_title"></has-error>
                  </div>
                 <div class="form-group">
                      <label for="image">Image</label>
                      <input type="file" name="image" @change="changePhoto($event)" :class="{ 'is-invalid': form.errors.has('image') }" >
                      <label for="">Old Image :</label>
                       <img :src="`storage/sliders/${form.image}`" alt="Removed old image" height="70px" width="70px">
                       <label for="">New Image :</label>
                       <img  :src="form.image" alt="No image selected" height="70px" width="70px">
                       <has-error :form="form" field="image"></has-error>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    </div>
</template>
<script>
export default {
        name:"Edit",
        data() {
            return {
                form :new Form({
                    title:'',
                    sub_title:'',
                    image:''
                })
            }
        },
        mounted() {
            this.$store.dispatch('sliderList');

        },
        created() {
             axios.get(`admin/slider/${this.$route.params.id}/edit/`).then((response)=>{
                this.form.fill(response.data.slider)
            })
        },
        computed: {
            getSliderList(){
                return this.$store.getters.getSlider;
            }
        },
        methods: {
             changePhoto(event){
                 let file = event.target.files[0];
                 let reader = new FileReader();
                 reader.onload = event=> {
                 // The file's text will be printed here
                 this.form.image = event.target.result
                 };

                 reader.readAsDataURL(file);
            },
        updateSlider(){
         this.form.put(`/admin/slider/${this.$route.params.id}`).then((response) => {
                    this.$router.push('/slider-list')
                    Toast.fire({
                        icon: 'success',
                        title: 'Slider updated successfully'
                        })

                }).catch((err) => {

                });
        }
        }
}
</script>
<style lang="stylus" scoped>

</style>

