<template>
    <div>
      <div class="container-fluid">
         <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{  getDashboardOrdersList }}</h3>

                <p>Reservation Requests</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{  getDashboardCategoriesList }}</h3>

                <p>Total Categories</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{  getDashboardMessageList }}</h3>

                <p>Total Messages</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3> {{ getDashboardItemsList }} </h3>

                <p>Total Items</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Reservation Request List</h3>

            </div>

            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Date and Time</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(reservation, index) in getDashboardRequestList" :key="reservation.id">
                  <td>{{ index+1 }}</td>
                  <td>{{ reservation.name }}</td>
                  <td>{{ reservation.phone }}</td>
                  <td>{{ reservation.date_and_time}}</td>
                  <td v-if="reservation.status == 1">
                      <span class="badge badge-info">confirmed</span>
                  </td>
                  <td v-else>
                      <span class="badge badge-danger">waiting</span>
                  </td>
                  <td v-if="reservation.status == 0">
                       <button class="btn btn-success btn-sm" @click.prevent="confirmStatus(reservation.id)"> confirm </button>
                  </td>
                  <td v-else>
                       <button class="btn btn-danger btn-sm" @click.prevent="deleteRequest(reservation.id)"> delete </button>
                  </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Date and Time</th>
                  <th>Status</th>
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

    </div>
    </div>
</template>
<script>
export default {
        name:"Home",
        mounted() {
          this.$store.dispatch("dashboardList")
        },
        computed:{
           getDashboardItemsList(){
            return this.$store.getters.getDashboardItems;
          },
          getDashboardCategoriesList(){
            return this.$store.getters.getDashboardCategories;
          },
          getDashboardOrdersList(){
            return this.$store.getters.getDashboardOrders;
          },
          getDashboardMessageList(){
            return this.$store.getters.getDashboardMessage;
          },
          getDashboardRequestList(){
            return this.$store.getters.getDashboardRequest;
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
