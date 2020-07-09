<template>
<div>
            <!-- Main content -->
 <section class="content">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Sliders List</h3>

                <div class="card-tools">
                  <button class="btn btn-primary">
                 <router-link to="/slider-new" style="color:#ffff;">Add Slider</router-link>
                  </button>
                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Title</th>
                  <th>Image</th>
                  <th>Update </th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(slider, index) in getSliderList" :key="slider.id">
                  <td>{{ index+1 }}</td>
                  <td>{{ slider.title }}</td>
                  <td> <img :src="imagePath(slider.image)" :alt="slider.title" height="50px" width="50px"> </td>
                  <td>{{ slider.created_at | timeFormat}}</td>
                  <td>
                      <router-link :to="`/slider-edit/${slider.id}`">Edit</router-link> |
                      <a href="" @click.prevent="deleteSlider(slider.id)">Delete</a>
                  </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                   <th>SL</th>
                  <th>Title</th>
                  <th>Image</th>
                  <th>Update </th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
</div>
</template>
<script>
export default {
        name:"List",
        mounted() {
          this.$store.dispatch("sliderList")
        },
        computed:{
           getSliderList(){
            return this.$store.getters.getSlider
          }
        },
        methods: {
            imagePath(image){
            return "/storage/sliders/"+image;
        },
            deleteSlider(id){
                axios.delete('/admin/slider/'+id).then(()=>{
                    this.$store.dispatch("sliderList");
                    Toast.fire({
                    icon: "success",
                    title: "Slider deleted successfully"
                });
                })
            }
        }
}
</script>

<style lang="stylus" scoped>

</style>
