<template>
<div>
            <!-- Main content -->
 <section class="content">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Reservation List</h3>

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
                <tr v-for="(reservation, index) in getReservationList" :key="reservation.id">
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
      <!-- /.row -->
    </section>
</div>
</template>
<script>
export default {
        name:"List",
        mounted() {
          this.$store.dispatch("reservationList")
        },
        computed:{
           getReservationList(){
            return this.$store.getters.getReservation;
          }
        },
        methods: {
             confirmStatus(id){
                 axios.post('/admin/reservation/status/'+id).then(()=>{
                    this.$store.dispatch("reservationList");
                    Toast.fire({
                    icon: "success",
                    title: "Reservation done successfully"
                        })

                }).catch((err) => {

                });
            },
            deleteRequest(id){
                 axios.delete('/admin/reservation/delete/'+id).then(()=>{
                    this.$store.dispatch("reservationList");
                    Toast.fire({
                    icon: "success",
                    title: "Reservation request delete successfully"
                        })

                }).catch((err) => {

                });
            },
        }
}
</script>

<style lang="stylus" scoped>

</style>
