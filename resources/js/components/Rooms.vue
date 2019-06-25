<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10"><h2>Hotel Rooms</h2></div>
            <div class="col-md-2 pull-right">
                <a class="btn btn-success" href="#"
                   @click="initCreate()">Add a room</a>
            </div>
        </div>

        <div class="card card-body mb-2" v-for="(room, index) in rooms" v-bind:key="room.id">
            <div class="row">
                <div class="col-md-10"><h3>{{room.hotel_name}}</h3>  </div>
                <div class="pull-right col-md-2">
                    <a class="dropdown-item text-primary" href="#"
                       @click="initUpdate(index)">Edit room</a> <br />
                    <a class="dropdown-item text-danger" href="#"
                       @click="initDelete(index)">Delete room</a>


                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p>
                         <br>
                        Hotel: <span>{{room.hotel_name}}</span><br />
                        Capacity: <span>{{room.room_capacity}}</span><br />
                        Room Type: <span>{{room.room_type}}</span><br />

                    </p>
                </div>
                <div class="col-md-6">
                    <img :src= "`../../images/rooms/${room.room_image}`"  height="200px" width="250px" >
                </div>
            </div>


        </div>

        <!-- Create Modal Form -->
        <div class="modal fade" tabindex="-1" role="dialog" id="create-room-model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Hotel room</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>
                        <form class="form" id="create-room"  @submit="formSubmit" enctype="multipart/form-data">
                            <input type="hidden" id="_token" :value="csrf">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="room_name">Room Name:</label>
                                    <input type="text" class="form-control" id="room_name" name="room_name"
                                           v-model= "room.room_name" />
                                </div>
                                <div class="col-md-6">
                                    <label for="hotel_id">Hotel:</label>
                                    <select v-model="room.hotel_id" name="hotel_id" id="hotel_id" class="browser-default custom-select" tabindex="2">

                                        <option v-for="(hotel, index) in hotels" :key="index" :value="hotel.id">{{ hotel.hotel_name }}</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="room_type_id">Type:</label>
                                    <select v-model="room.room_type_id" id="room_type_id" name="room_type_id" class="browser-default custom-select" tabindex="2">

                                        <option v-for="(type, index) in room_types" :key="index" :value="type.id">{{ type.room_type }}</option>

                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="room_capacity_id">Capacity:</label>
                                    <select v-model="room.room_capacity_id" id="room_capacity_id" name="room_capacity_id"  class="browser-default custom-select" tabindex="2">

                                        <option v-for="(capacity, index) in room_capacities" :key="index" :value="capacity.id">{{ capacity.room_capacity }}</option>

                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <label for="room_image">Image:</label>
                                    <input type="file" class="form-control" id="room_image" name="room_image"
                                           v-on:change="onImageChange">
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
        <div class="modal fade" tabindex="-1" role="dialog" id="edit-room-model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Hotel room</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>
                        <form class="form" id="edit-room"  @submit="formEditSubmit" enctype="multipart/form-data">
                            <input type="hidden" id="_token" :value="csrf">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="room_name">Room Name:</label>
                                    <input type="text" class="form-control" name="room_name"
                                           v-model= "room.room_name" />
                                </div>
                                <div class="col-md-6">
                                    <label for="hotel_id">Hotel:</label>
                                    <select v-model="room.hotel_id" name="hotel_id"  class="browser-default custom-select" tabindex="2">

                                        <option v-for="(hotel, index) in hotels" :key="index" :value="hotel.id">{{ hotel.hotel_name }}</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="room_type_id">Type:</label>
                                    <select v-model="room.room_type_id" name="room_type_id" class="browser-default custom-select" tabindex="2">

                                        <option v-for="(type, index) in room_types" :key="index" :value="type.id">{{ type.room_type }}</option>

                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="room_capacity_id">Capacity:</label>
                                    <select v-model="room.room_capacity_id"  name="room_capacity_id"  class="browser-default custom-select" tabindex="2">

                                        <option v-for="(capacity, index) in room_capacities" :key="index" :value="capacity.id">{{ capacity.room_capacity }}</option>

                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <label for="room_image">Image:</label>
                                    <input type="file" class="form-control" name="room_image"
                                           v-on:change="onImageChange">
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
                rooms: [],
                hotels: [],
                room_types: [],
                room_capacities: [],
                errors: [],
                update_room : {},
                room : {
                    id: '',
                    room_name: '',
                    hotel_id: '',
                    room_type_id: '',
                    room_capacity_id: '',

                },
                room_id : '',
                image : '',
                edit : false,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        created(){
            this.fetchHotels();
            this.fetchRooms();
            this.fetchRoomTypes();
            this.fetchRoomcapacity();
        },
        methods: {
            fetchHotels(){
                fetch('api/hotels/')
                    .then(res => res.json())
                    .then(res => {
                        this.hotels = res.data

                        console.log(this.room)

                    })
            },
            fetchRooms(){
                fetch('api/rooms/')
                    .then(res => res.json())
                    .then(res => {
                        this.rooms = res.data


                    })
            },
            fetchRoomTypes(){
                fetch('api/types')
                    .then(res => res.json())
                    .then(res => {
                        this.room_types = res.data

                    })
            },
            fetchRoomcapacity(){
                fetch('api/capacity')
                    .then(res => res.json())
                    .then(res => {
                        this.room_capacities = res.data

                    })
            },
            initCreate()
            {
                this.errors = [];
                this.room = [];
                $('#create-form').trigger('reset');
                $("#create-room-model").modal("show");


            },
            initUpdate(index)
            {
                this.errors = [];
                this.edit = true;
                $("#edit-room-model").modal("show");
                this.room = this.rooms[index];


            },
            onImageChange(e){
                console.log(e.target.files[0]);
                this.image = e.target.files[0];
            },
            formSubmit(e)
            {
                e.preventDefault();
               /*
               *Converting form to accept files
                */
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }


                let form  = document.getElementById('create-room');
                var mydata = new FormData(form);
               // var form_data = $('form#create-room').serializeArray();
                //
                console.log(mydata);
                mydata.append('room_image' , this.image);

                axios.post('api/rooms/save', mydata, config)
                    .then(response => {

                        $("#create-room-model").modal("hide");

                    })
                    .catch(error => {
                        this.errors = [];
                        // validation for room name
                        if (error.response.data.errors.room_name) {
                            this.errors.push(error.response.data.errors.room_name[0]);
                        }
                        // validation for hotel id
                        if (error.response.data.errors.hotel_id) {
                            this.errors.push(error.response.data.errors.hotel_id[0]);
                        }
                        // validation for room_type id
                        if (error.response.data.errors.room_type_id) {
                            this.errors.push(error.response.data.errors.room_type_id[0]);
                        }
                        // validation for room_capacity id
                        if (error.response.data.errors.room_capacity_id) {
                            this.errors.push(error.response.data.errors.room_capacity_id[0]);
                        }

                    });
            },
            formEditSubmit(e)
            {
                e.preventDefault();


                /*
                *Converting form to accept files
                 */
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }


                let form  = document.getElementById('edit-room');
                var mydata = new FormData(form);

                // var form_data = $('form#create-room').serializeArray();
                //


                 mydata.append('room_image' , this.image);
                 mydata.append('id' , this.room.id);
/*
(Update) to the PUT route of the Laravel API
 */
                axios.put('api/rooms/edit', mydata, config)
                    .then(response => {

                        $("#edit-room-model").modal("hide");

                    })
                    .catch(error => {
                        this.errors = [];
                        // validation for room name
                        if (error.response.data.errors.room_name) {
                            this.errors.push(error.response.data.errors.room_name[0]);
                        }
                        // validation for hotel id
                        if (error.response.data.errors.hotel_id) {
                            this.errors.push(error.response.data.errors.hotel_id[0]);
                        }
                        // validation for room_type id
                        if (error.response.data.errors.room_type_id) {
                            this.errors.push(error.response.data.errors.room_type_id[0]);
                        }
                        // validation for room_capacity id
                        if (error.response.data.errors.room_capacity_id) {
                            this.errors.push(error.response.data.errors.room_capacity_id[0]);
                        }

                    });
            },
        }

    }
</script>
