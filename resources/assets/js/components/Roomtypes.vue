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
                            <tr v-for="(type, index) in types" :key="type.id">

                                <td >{{type.room_type}}</td>
                                <td >{{type.status}}</td>
                                <td >{{type.created_at}}</td>
                                <td >
                                    <a  href="#"
                                        @click="initUpdate(index)"><i class="fa fa-edit blue"></i> </a> |
                                    <a href="#"
                                       @click="typeDelete(type)"><i class="fa fa-trash red"></i></a>



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
        <div class="modal fade" tabindex="-1" role="dialog" id="create-type-model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add room type</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                    </div>
                    <div class="modal-body">


                        <form class="form" id="create-type"  @submit.prevent="formSubmit">
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

        <!-- Edit modal Form starts here -->
        <div class="modal fade" tabindex="-1" role="dialog" id="edit-type-model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Room type</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                    </div>
                    <div class="modal-body">


                        <form class="form" id="edit-type"  @submit="formEditSubmit" >
                            <input type="hidden" id="_token" :value="csrf">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="room_type">Room Name:</label>
                                    <input type="text" class="form-control" name="room_type"
                                           v-model= "form.room_type" />
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
                type: {},
                 form : new Form({
                    id: '',
                     room_type: '',
                         }),
                type_id : '',
                edit : false,
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
                this.type = [];
                $('#create-form').trigger('reset');
                $("#create-type-model").modal("show");


            },
            initUpdate(index)
            {
                this.edit = true;
                $("#edit-type-model").modal("show");
                this.type = this.types[index];



            },

            formSubmit()
            {
                let form  = document.getElementById('create-type');
                var mydata = new FormData(form);
                this.form.post('api/types/save', mydata).then(() => {
                    Fire.$emit("AfterCreate");
                    toast.fire({
                        type: 'success',
                        title: 'Room type created successfully'
                    })
                    $("#create-type-model").modal("hide");

                }).catch()
                    .then(response => {


                    })

            },
            formEditSubmit()
            {

                /*
                *Converting form to accept files
                 */


                let form  = document.getElementById('edit-type');
                var mydata = new FormData(form);


                mydata.append('id' , this.type.id);
                /*
                (Update) to the PUT route of the Laravel API
                 */

                axios.put('api/types/edit', mydata)
                    .then(response => {

                        $("#edit-type-model").modal("hide");

                    })

            },
            typeDelete(index){
                if(confirm("Do you want to remove this room type? ")){

                    axios.delete('api/types/del/'+ index.id)
                        .then(response => {


                        })
                        .catch(error => {


                        });
                }

            }
        }

    }
</script>
