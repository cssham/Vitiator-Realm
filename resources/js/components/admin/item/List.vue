<template>
    <div>
        <section class="content">
      <div class="row">
        <div class="col-12">

          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Items List</h3>

                <div class="card-tools">
                  <button class="btn btn-primary">
                 <router-link to="/item-new" style="color:#ffff;">Add Item</router-link>
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
                  <th>Category</th>
                  <th>Image</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Offered Price</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, index) in getItemList" :key="item.id">
                  <td> {{ index+1 }} </td>
                  <td> {{ item.name }} </td>
                  <td> {{ item.category.name }} </td>
                  <td> <img :src="imagePath(item.image)" :alt="item.name" height="50px" width="50px"> </td>
                  <td> {{ item.short_description | shortLength(25,"...")}} </td>
                  <td> {{ item.price }}</td>
                  <td> {{ item.offered_price }} </td>
                  <td>
                      <router-link :to="`/item-edit/${item.id}`">Edit</router-link> |
                     <a href="" @click.prevent="deleteItem(item.id)">Delete</a>
                  </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Image</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Offered Price</th>
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
        this.$store.dispatch("itemList")
    },
    computed: {
        getItemList(){
            return this.$store.getters.getItem
        }
    },
    methods: {
        imagePath(image){
            return "/storage/items/"+image;
        },
        deleteItem(id){
                axios.delete('/admin/item/'+id).then(()=>{
                    this.$store.dispatch("itemList");
                    Toast.fire({
                    icon: "success",
                    title: "Item deleted successfully"
                });
                })
            }
    },
}
</script>
<style lang="stylus" scoped>

</style>
