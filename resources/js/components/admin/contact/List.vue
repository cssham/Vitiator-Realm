<template>
<div>
            <!-- Main content -->
 <section class="content">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Contact Message List</h3>

            </div>

            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(contact, index) in getContactList" :key="contact.id">
                  <td>{{ index+1 }}</td>
                  <td>{{ contact.name }}</td>
                  <td>{{ contact.email }}</td>
                  <td>{{ contact.subject}}</td>
                  <td>{{ contact.message}}</td>
                  <td>
                      <button class="btn btn-danger btn-sm" @click.prevent="deleteMessage(contact.id)"> delete </button>
                  </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Subject</th>
                  <th>Message</th>
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
          this.$store.dispatch("contactList")
        },
        computed:{
           getContactList(){
            return this.$store.getters.getContact;
          }
        },
        methods: {

            deleteMessage(id){
                 axios.delete('/admin/contact/delete/'+id).then(()=>{
                    this.$store.dispatch("contactList");
                    Toast.fire({
                    icon: "success",
                    title: "Message delete successfully"
                        })

                }).catch((err) => {

                });
            },
        }
}
</script>

<style lang="stylus" scoped>

</style>
