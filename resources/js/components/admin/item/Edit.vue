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
                <h3 class="card-title">Edit Item</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" enctype="multipart/form-data" @submit.prevent="updateItem()">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <select name="category_id" id="category_id" class="form-control" v-model="form.category_id" :class="{ 'is-invalid': form.errors.has('category_id') }">
                            <option v-for="category in getCategoryList" :key="category.id" :value="category.id">{{  category.name  }}</option>
                        </select>
                         <has-error :form="form" field="category_id"></has-error>
                    </div>
                  <div class="form-group">
                    <label for="name">Item Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Item Name" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }">
                    <has-error :form="form" field="name"></has-error>
                  </div>
                  <div class="form-group">
                      <label for="image">Image</label>
                      <input type="file" name="image" @change="changePhoto($event)" :class="{ 'is-invalid': form.errors.has('image') }" >
                      <label for="">Old Image :</label>
                       <img :src="`storage/items/${form.image}`" alt="Removed old image" height="70px" width="70px">
                       <label for="">New Image :</label>
                       <img  :src="form.image" alt="No image selected" height="70px" width="70px">
                       <has-error :form="form" field="image"></has-error>
                  </div>
                    <div class="form-group">
                        <label for="short_description">Short Description</label>
                        <textarea class="form-control" id="short_description" name="short_description" v-model="form.short_description" :class="{ 'is-invalid': form.errors.has('short_description') }">
                        </textarea>
                         <has-error :form="form" field="short_description"></has-error>
                    </div>
                    <div class="form-group">
                        <label for="long_description">Long Description</label>
                        <!-- <textarea class="form-control" id="long_description" name="long_description" v-model="form.long_description" :class="{ 'is-invalid': form.errors.has('long_description') }">
                        </textarea> -->
                        <v-md-editor v-model="form.long_description" height="400px"></v-md-editor>
                         <has-error :form="form" field="long_description"></has-error>
                    </div>
                    <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price"  v-model="form.price" :class="{ 'is-invalid': form.errors.has('price') }">
                    <has-error :form="form" field="price"></has-error>
                  </div>
                  <div class="form-group">
                    <label for="offered_name">Offered Price</label>
                    <input type="number" class="form-control" id="offered_price" name="offered_price"  v-model="form.offered_price" :class="{ 'is-invalid': form.errors.has('offered_price') }">
                    <has-error :form="form" field="offered_price" ></has-error>
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
                    category_id:'',
                    name:'',
                    image:'',
                    short_description:'',
                    long_description:'',
                    price:'',
                    offered_price:''
                })
            }
        },
        mounted() {
            this.$store.dispatch('categoryList');

        },
        created() {
             axios.get(`admin/item/${this.$route.params.id}/edit/`).then((response)=>{
                this.form.fill(response.data.item)
            })
        },
        computed: {
            getCategoryList(){
                return this.$store.getters.getCategory;
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
        updateItem(){
         this.form.put(`/admin/item/${this.$route.params.id}`).then((response) => {
                    this.$router.push('/item-list')
                    Toast.fire({
                        icon: 'success',
                        title: 'Item updated successfully'
                        })

                }).catch((err) => {

                });
        }
        }
}
</script>
<style lang="stylus" scoped>

</style>

