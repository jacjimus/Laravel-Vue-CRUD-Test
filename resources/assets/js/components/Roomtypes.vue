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
                            <tr v-for="(type, index) in types" v-bind:key="type.id">

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

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>
                        <form class="form" id="create-type"  @submit="formSubmit">
                            <input type="hidden" id="_token" :value="csrf">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="room_type">Room Type:</label>
                                    <input type="text" class="form-control" id="room_type" name="room_type"
                                           v-model= "type.room_type" />
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

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>
                        <form class="form" id="edit-type"  @submit="formEditSubmit" >
                            <input type="hidden" id="_token" :value="csrf">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="room_type">Room Name:</label>
                                    <input type="text" class="form-control" name="room_type"
                                           v-model= "type.room_type" />
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
                types: [],
                errors: [],
                 type : {
                    id: '',
                     room_type: '',
                         },
                type_id : '',
                edit : false,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        created(){
            this.fetchTypes();
                  },
        methods: {
            fetchTypes(){
                fetch('api/types/')
                    .then(res => res.json())
                    .then(res => {
                        this.types = res.data


                    })
            },



            initCreate()
            {
                this.errors = [];
                this.type = [];
                $('#create-form').trigger('reset');
                $("#create-type-model").modal("show");


            },
            initUpdate(index)
            {
                this.errors = [];
                this.edit = true;
                $("#edit-type-model").modal("show");
                this.type = this.types[index];


            },

            formSubmit(e)
            {
                e.preventDefault();


                let form  = document.getElementById('create-type');
                var mydata = new FormData(form);
                // var form_data = $('form#create-type').serializeArray();
                //

                axios.post('api/types/save', mydata)
                    .then(response => {

                        $("#create-type-model").modal("hide");

                    })
                    .catch(error => {
                        this.errors = [];
                        // validation for room type
                        if (error.response.data.errors.room_type) {
                            this.errors.push(error.response.data.errors.room_type[0]);
                        }


                    });
            },
            formEditSubmit(e)
            {
                e.preventDefault();


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
                    .catch(error => {
                        this.errors = [];
                        // validation for room type
                        if (error.response.data.errors.room_type) {
                            this.errors.push(error.response.data.errors.room_type[0]);
                        }


                    });
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
