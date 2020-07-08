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
                <h3 class="card-title">Edit Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }">
                    <has-error :form="form" field="name"></has-error>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" @click.prevent="updateCategory()">Update</button>
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
        mounted() {
            axios.get(`admin/category/${this.$route.params.id}/edit/`).then((response)=>{
                this.form.fill(response.data.category)
            })
        },
        data() {
            return {
                form: new Form({
                     'name':''
                }
                )
            }
        },
        methods: {
            updateCategory(){
                this.form.put(`/admin/category/${this.$route.params.id}`).then((response) => {
                    this.$router.push('/category-list')
                    Toast.fire({
                        icon: 'success',
                        title: 'Category updated successfully'
                        })

                }).catch((err) => {

                });
            }
        },
}
</script>
<style lang="stylus" scoped>

</style>

