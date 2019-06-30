<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Room types</h3>

                        <div class="card-tools">
                            <button @click="initCreate()" class="btn btn-success" >
                                Add New
                                <i class="fas fa-home fa-fw"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">

                            <thead>
                            <th>Room type</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Created at</th>
                            </thead>
                            <tbody>
                            <tr v-for="(type) in types" :key="type.id">

                                <td >{{type.room_type}}</td>
                                <td >{{type.status}}</td>
                                <td >{{type.created_at}}</td>
                                <td >
                                    <a  href="#"
                                        @click="initUpdate(type)"><i class="fa fa-edit blue"></i> </a> |
                                    <a href="#"
                                       @click="typeDelete(type.id)"><i class="fa fa-trash red"></i></a>



                                </td>


                            </tr>
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>


        <!-- Create Modal Form -->
        <div class="modal fade" tabindex="-1" role="dialog" id="type-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 v-show="!editMode" class="modal-title">Add room type</h4>
                        <h4 v-show="editMode" class="modal-title">Edit room type</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                    </div>
                    <div class="modal-body">


                        <form class="form" id="form-type"  @submit.prevent="!editMode ? formSubmit() : formEditSubmit()">
                            <input type="hidden" id="_token" :value="csrf">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="room_type">Room Type:</label>
                                    <input type="text" class="form-control" id="room_type" name="room_type" :class="{ 'is-invalid': form.errors.has('room_type') }"
                                           v-model= "form.room_type" />
                                    <has-error :form="form" field="room_type"></has-error>
                                </div>

                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


    </div>
</template>
<script>
    export default{
        data(){
            return {
                types: {},
                editMode: false,
                 form : new Form({
                     id: '',
                     room_type: '',
                         }),
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        created(){
            this.fetchTypes();
            Fire.$on('AfterCreate' , () => {this.fetchTypes()});
                  },
        methods: {
            fetchTypes(){
                axios.get('api/types')
                    .then(({data}) => ( this.types = data.data))
            },

     initCreate()
            {
                this.editMode = false;
                this.form.reset();
                $("#type-modal").modal("show");


            },
      initUpdate(type)
            {
                this.editMode = true;
                this.form.reset();
                $("#type-modal").modal("show");
                this.form.fill(type);



            },

            formSubmit()
            {
                let myform  = document.getElementById('form-type');
                var mydata = new FormData(myform);
                this.form.post('api/types/save', mydata).then(() => {
                    Fire.$emit("AfterCreate");
                    toast.fire({
                        type: 'success',
                        title: 'Room type created successfully'
                    })
                    $("#type-modal").modal("hide");

                }).catch()
                    .then(response => {


                    })

            },
            formEditSubmit()
            {

                /*
                *Converting form to accept files
                 */


                let myform  = document.getElementById('form-type');
                var mydata = new FormData(myform);


                mydata.append('id' , this.form.id);
                /*
                (Update) to the PUT route of the Laravel API
                 */

                this.form.put('api/types/edit', mydata).then(() => {
                    Fire.$emit("AfterCreate");
                    toast.fire({
                        type: 'success',
                        title: 'Room type updated successfully'
                    })
                    $("#type-modal").modal("hide");

                }).catch()
                    .then(response => {


                    })

            },
            typeDelete(id){
                swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.form.delete('api/types/del/' + id).then(() => {

                            Fire.$emit('AfterCreate');
                            toast.fire({
                                    type: 'success',
                                    title: 'Room type deleted successfully'
                                }
                            )

                        });
                    }


                })




            }
        }

    }
</script>
