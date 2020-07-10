<template>
<div>
            <!-- Main content -->
 <section class="content">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Category List</h3>

                <div class="card-tools">
                  <button class="btn btn-primary">
                 <router-link to="/category-new" style="color:#ffff;">Add Category</router-link>
                  </button>
                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Slug</th>
                  <th>Update </th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(category, index) in getCategoryList" :key="category.id">
                  <td>{{ index+1 }}</td>
                  <td>{{ category.name }}</td>
                  <td>{{ category.slug }}</td>
                  <td>{{ category.created_at | timeFormat}}</td>
                  <td>
                      <router-link :to="`/category-edit/${category.id}`" class="btn btn-info btn-sm">Edit</router-link>
                      <a href="" @click.prevent="deleteCategory(category.id)" class="btn btn-danger btn-sm">Delete</a>
                  </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                   <th>SL</th>
                  <th>Name</th>
                  <th>Slug</th>
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
          this.$store.dispatch("categoryList")
        },
        computed:{
           getCategoryList(){
            return this.$store.getters.getCategory
          }
        },
        methods: {
            deleteCategory(id){
                axios.delete('/admin/category/'+id).then(()=>{
                    this.$store.dispatch("categoryList");
                    Toast.fire({
                    icon: "success",
                    title: "Category deleted successfully"
                });
                })
            }
        }
}
</script>

<style lang="stylus" scoped>

</style>
